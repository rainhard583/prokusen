<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Midtrans as MidtransConfig;

class Payment extends BaseController
{
    protected $db;
    protected $midtrans;

    public function __construct()
    {
        $this->db       = db_connect();
        $this->midtrans = new MidtransConfig();
        helper(['url']);
    }

    // ============================================================
    // BUAT SNAP TOKEN UNTUK SEBUAH ORDER
    // Dipanggil via AJAX dari pesanan-sukses.php setelah order dibuat
    // POST /payment/snap-token
    // body: order_id
    // ============================================================
    public function snapToken()
    {
        $orderId = $this->request->getPost('order_id');

        $order = $this->db->table('orders')
            ->where('id', $orderId)
            ->get()
            ->getRowArray();

        if (!$order) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Pesanan tidak ditemukan'
            ]);
        }

        // Ambil item-item pesanan untuk item_details (opsional tapi disarankan Midtrans)
        $items = $this->db->table('order_items')
            ->where('order_id', $orderId)
            ->get()
            ->getResultArray();

        $itemDetails = [];
        foreach ($items as $it) {
            $itemDetails[] = [
                'id'       => (string) ($it['id'] ?? uniqid()),
                'price'    => (int) $it['price'],
                'quantity' => (int) $it['qty'],
                'name'     => substr($it['product_name'] ?? 'Produk', 0, 50),
            ];
        }

        // Kalau total item_details tidak sama dengan total_price, Midtrans akan menolak
        // Jadi kalau kosong / tidak sama, kita skip item_details dan kirim gross_amount saja
        $sumItems = 0;
        foreach ($itemDetails as $it) {
            $sumItems += $it['price'] * $it['quantity'];
        }

        // order_number harus unik untuk Midtrans -> gunakan order_number + id
        $midtransOrderId = $order['order_number'] . '-' . $order['id'];

        $payload = [
            'transaction_details' => [
                'order_id'     => $midtransOrderId,
                'gross_amount' => (int) $order['total_price'],
            ],
            'customer_details' => [
                'first_name' => $order['customer_name'] ?? 'Pelanggan',
                'email'      => $order['customer_email'] ?? 'customer@example.com',
                'phone'      => $order['phone'] ?? '',
            ],
            'callbacks' => [
                'finish' => base_url('riwayat'),
            ],
        ];

        if (!empty($itemDetails) && $sumItems == (int) $order['total_price']) {
            $payload['item_details'] = $itemDetails;
        }

        // Simpan midtrans_order_id ke tabel orders supaya bisa dicocokkan saat notification
        $this->db->table('orders')
            ->where('id', $orderId)
            ->update(['midtrans_order_id' => $midtransOrderId]);

        // ==================================================
        // REQUEST KE MIDTRANS SNAP API
        // ==================================================
        $serverKey = $this->midtrans->serverKey;
        $authString = base64_encode($serverKey . ':');

        $ch = curl_init($this->midtrans->snapApiUrl());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization: Basic ' . $authString,
        ]);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Koneksi ke Midtrans gagal: ' . $curlError,
            ]);
        }

        $result = json_decode($response, true);

        if ($httpCode != 201 || empty($result['token'])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => $result['error_messages'][0] ?? 'Gagal membuat transaksi Midtrans',
                'raw'     => $result,
            ]);
        }

        return $this->response->setJSON([
            'success'    => true,
            'snap_token' => $result['token'],
            'order_id'   => $orderId,
        ]);
    }

    // ============================================================
    // UPDATE STATUS DARI FRONTEND (saat snap callback onSuccess/onPending/onError)
    // Ini untuk UX cepat saja — status final tetap dikonfirmasi via notification()
    // POST /payment/update-status
    // body: order_id, status_pembayaran (capture/settlement/pending/deny/expire/cancel)
    // ============================================================
    public function updateStatusFrontend()
    {
        $orderId = $this->request->getPost('order_id');
        $mtStatus = $this->request->getPost('transaction_status');

        $order = $this->db->table('orders')->where('id', $orderId)->get()->getRowArray();

        if (!$order) {
            return $this->response->setJSON(['success' => false, 'message' => 'Order tidak ditemukan']);
        }

        $mapped = $this->mapMidtransStatus($mtStatus);

        $this->db->table('orders')->where('id', $orderId)->update([
            'status'            => $mapped['status'],
            'status_pembayaran' => $mapped['status_pembayaran'],
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);

        return $this->response->setJSON(['success' => true]);
    }

    // ============================================================
    // NOTIFICATION HANDLER / WEBHOOK MIDTRANS
    // Set URL ini di Dashboard Midtrans > Settings > Konfigurasi (Payment Notification URL)
    // Contoh: https://domainanda.com/payment/notification
    //
    // Route: POST /payment/notification  (TANPA cek session, harus public!)
    // ============================================================
    public function notification()
    {
        $json = $this->request->getBody();
        $notif = json_decode($json, true);

        if (!$notif || empty($notif['order_id'])) {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Invalid payload']);
        }

        $midtransOrderId  = $notif['order_id'];
        $statusCode       = $notif['status_code'] ?? '';
        $grossAmount      = $notif['gross_amount'] ?? '';
        $serverKey        = $this->midtrans->serverKey;
        $signatureKey     = $notif['signature_key'] ?? '';

        // ==================================================
        // VERIFIKASI SIGNATURE KEY (WAJIB untuk keamanan)
        // signature_key = SHA512(order_id + status_code + gross_amount + ServerKey)
        // ==================================================
        $expectedSignature = hash('sha512', $midtransOrderId . $statusCode . $grossAmount . $serverKey);

        if ($signatureKey !== $expectedSignature) {
            return $this->response->setStatusCode(403)->setJSON(['message' => 'Invalid signature']);
        }

        // Cari order berdasarkan midtrans_order_id
        $order = $this->db->table('orders')
            ->where('midtrans_order_id', $midtransOrderId)
            ->get()
            ->getRowArray();

        if (!$order) {
            return $this->response->setStatusCode(404)->setJSON(['message' => 'Order not found']);
        }

        $transactionStatus = $notif['transaction_status'] ?? '';
        $fraudStatus       = $notif['fraud_status'] ?? null;

        $mapped = $this->mapMidtransStatus($transactionStatus, $fraudStatus);

        $this->db->table('orders')
            ->where('id', $order['id'])
            ->update([
                'status'            => $mapped['status'],
                'status_pembayaran' => $mapped['status_pembayaran'],
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);

        return $this->response->setJSON(['message' => 'OK']);
    }

    // ============================================================
    // LANJUTKAN PEMBAYARAN PENDING (dipanggil dari detail-pesanan)
    // POST /payment/lanjutkan
    // ============================================================
    public function lanjutkanPembayaran()
    {
        $orderId = $this->request->getPost('order_id');

        $order = $this->db->table('orders')
            ->where('id', $orderId)
            ->get()
            ->getRowArray();

        if (!$order) {
            return $this->response->setJSON(['success' => false, 'message' => 'Pesanan tidak ditemukan']);
        }

        if ($order['status'] !== 'pending') {
            return $this->response->setJSON(['success' => false, 'message' => 'Status pesanan bukan pending']);
        }

        // Cek apakah snap_token lama masih valid (belum expired)
        $snapToken     = $order['snap_token']      ?? null;
        $snapExpiredAt = $order['snap_expired_at'] ?? null;
        $masihValid    = false;

        if (!empty($snapToken) && !empty($snapExpiredAt)) {
            $masihValid = (strtotime($snapExpiredAt) - 300) > time(); // buffer 5 menit
        }

        if ($masihValid) {
            // Pakai token lama
            return $this->response->setJSON([
                'success'    => true,
                'snap_token' => $snapToken,
                'order_id'   => $orderId,
            ]);
        }

        // Token expired / belum ada → buat transaksi baru ke Midtrans
        $items = $this->db->table('order_items')
            ->where('order_id', $orderId)
            ->get()
            ->getResultArray();

        $itemDetails = [];
        $sumItems    = 0;
        foreach ($items as $it) {
            $itemDetails[] = [
                'id'       => (string) $it['id'],
                'price'    => (int) $it['price'],
                'quantity' => (int) $it['qty'],
                'name'     => substr($it['product_name'] ?? 'Produk', 0, 50),
            ];
            $sumItems += (int) $it['price'] * (int) $it['qty'];
        }

        // Suffix -R+timestamp agar order_id Midtrans unik (tidak bentrok yg expired)
        $midtransOrderId = $order['order_number'] . '-' . $order['id'] . '-R' . time();

        $payload = [
            'transaction_details' => [
                'order_id'     => $midtransOrderId,
                'gross_amount' => (int) $order['total_price'],
            ],
            'customer_details' => [
                'first_name' => $order['customer_name'] ?? 'Pelanggan',
                'email'      => $order['customer_email'] ?? 'customer@example.com',
                'phone'      => $order['phone'] ?? '',
            ],
            'callbacks' => ['finish' => base_url('riwayat')],
        ];

        if (!empty($itemDetails) && $sumItems == (int) $order['total_price']) {
            $payload['item_details'] = $itemDetails;
        }

        $serverKey  = $this->midtrans->serverKey;
        $authString = base64_encode($serverKey . ':');

        $ch = curl_init($this->midtrans->snapApiUrl());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization: Basic ' . $authString,
        ]);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

        $response  = curl_exec($ch);
        $httpCode  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            return $this->response->setJSON(['success' => false, 'message' => 'Koneksi ke Midtrans gagal: ' . $curlError]);
        }

        $result = json_decode($response, true);

        if ($httpCode != 201 || empty($result['token'])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => $result['error_messages'][0] ?? 'Gagal membuat transaksi Midtrans',
            ]);
        }

        // Simpan token baru ke DB
        $this->db->table('orders')->where('id', $orderId)->update([
            'midtrans_order_id' => $midtransOrderId,
            'snap_token'        => $result['token'],
            'snap_expired_at'   => date('Y-m-d H:i:s', strtotime('+24 hours')),
        ]);

        return $this->response->setJSON([
            'success'    => true,
            'snap_token' => $result['token'],
            'order_id'   => $orderId,
        ]);
    }

    // ============================================================
    // MAPPING STATUS MIDTRANS -> STATUS APLIKASI
    // ============================================================
    private function mapMidtransStatus($transactionStatus, $fraudStatus = null)
    {
        $transactionStatus = strtolower((string) $transactionStatus);
        $fraudStatus       = $fraudStatus !== null ? strtolower((string) $fraudStatus) : null;

        switch ($transactionStatus) {

            case 'capture':
                if ($fraudStatus === 'accept' || $fraudStatus === null) {
                    return ['status' => 'success', 'status_pembayaran' => 'Lunas'];
                }
                if ($fraudStatus === 'challenge') {
                    return ['status' => 'pending', 'status_pembayaran' => 'Pending'];
                }
                return ['status' => 'cancelled', 'status_pembayaran' => 'Gagal'];

            case 'settlement':
                return ['status' => 'success', 'status_pembayaran' => 'Lunas'];

            case 'pending':
                return ['status' => 'pending', 'status_pembayaran' => 'Pending'];

            case 'deny':
            case 'cancel':
            case 'failure':
                return ['status' => 'cancelled', 'status_pembayaran' => 'Gagal'];

            case 'expire':
                return ['status' => 'cancelled', 'status_pembayaran' => 'Expired'];

            case 'refund':
            case 'partial_refund':
                return ['status' => 'cancelled', 'status_pembayaran' => 'Refund'];

            default:
                return ['status' => 'pending', 'status_pembayaran' => 'Pending'];
        }
    }
}