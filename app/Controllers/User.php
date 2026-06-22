<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class User extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = db_connect();
        helper(['url', 'form']);
    }

    // ============================================================
    // BERANDA
    // ============================================================

    public function index()
    {
        // Ambil produk aktif untuk ditampilkan di beranda (opsional)
        $produk = $this->db->table('products')
            ->where('is_active', 1)
            ->limit(8)
            ->orderBy('id', 'DESC')
            ->get()
            ->getResultArray();

        $data['produk'] = $produk;

        return view('frontend/beranda', $data);
    }

    // ============================================================
    // DAFTAR PRODUK
    // ============================================================

    public function produk()
    {
        $keyword  = $this->request->getGet('keyword');
        $kategori = $this->request->getGet('kategori');

        $builder = $this->db->table('products')
            ->where('is_active', 1);

        if ($keyword) {
            $builder->groupStart()
                ->like('name', $keyword)
                ->orLike('description', $keyword)
                ->groupEnd();
        }

        if ($kategori && $kategori !== 'Semua') {
            $builder->where('category', $kategori);
        }

        $builder->orderBy('id', 'DESC');

        $data['produk']   = $builder->get()->getResultArray();
        $data['keyword']  = $keyword;
        $data['kategori'] = $kategori;

        return view('frontend/produk', $data);
    }

    // ============================================================
    // DETAIL PRODUK
    // ============================================================

    public function detailProduk($id)
{
    $produk = $this->db->table('products')
        ->where('id', $id)
        ->where('is_active', 1)
        ->get()
        ->getRowArray();

    if (!$produk) {
        return redirect()->to(base_url('produk-user'));
    }

    $data['produk'] = $produk;

    return view('frontend/detail-produk', $data);
}

    // ============================================================
    // KERANJANG & PESANAN
    // ============================================================

    public function pesanan()
    {
        // Ambil keranjang dari session
        $keranjang = session()->get('keranjang') ?? [];

        if (empty($keranjang)) {
            return redirect()->to(base_url('produk'));
        }

        $data['keranjang'] = $keranjang;
        $data['total']     = array_sum(array_column($keranjang, 'subtotal'));

        return view('frontend/pesanan', $data);
    }

public function tambahKeranjang($id)
{
    // CEK LOGIN
    if (!session()->get('logged_in_user')) {

        return redirect()->to(base_url('login'))
            ->with('error', 'Silakan login dahulu');
    }

    $db = db_connect();

    $produk = $db->table('products')
        ->where('id', $id)
        ->get()
        ->getRowArray();

    if (!$produk) {

        return redirect()->back();
    }

    $qty = (int) $this->request->getPost('qty');

    if ($qty < 1) {

        $qty = 1;
    }

    $keranjang = session()->get('keranjang') ?? [];

    // qty lama di keranjang
    $qtyLama = isset($keranjang[$id])
        ? $keranjang[$id]['qty']
        : 0;

    // total qty setelah ditambah
    $totalQty = $qtyLama + $qty;

    // CEK STOK
    if ($totalQty > $produk['stock']) {

        return redirect()->back()
            ->with('error', 'Stock tidak mencukupi');
    }

    if (isset($keranjang[$id])) {

        $keranjang[$id]['qty'] += $qty;

    } else {

        $keranjang[$id] = [

            'id'       => $produk['id'],
            'name'     => $produk['name'],
            'price'    => $produk['price'],
            'image'    => $produk['image'],
            'stock'    => $produk['stock'],
            'qty'      => $qty,
            'subtotal' => $produk['price'] * $qty
        ];
    }

    $keranjang[$id]['subtotal'] =
        $keranjang[$id]['price'] *
        $keranjang[$id]['qty'];

    session()->set('keranjang', $keranjang);

    session()->setFlashdata('success', $produk['name'] . ' berhasil ditambahkan ke keranjang');

    return redirect()->back();
}

    public function updateKeranjang($id)
{
    $db = db_connect();

    $aksi = $this->request->getGet('aksi');
    $qtyDirect = $this->request->getGet('qty'); // support ?qty=N langsung

    $keranjang = session()->get('keranjang') ?? [];

    if (isset($keranjang[$id])) {

        // =====================================
        // CEK PRODUK (untuk validasi stok)
        // =====================================

        $produk = $db->table('products')
            ->where('id', $id)
            ->get()
            ->getRowArray();

        $maxStock = $produk ? (int) $produk['stock'] : 999;

        // =====================================
        // MODE ?qty=N (dari pesanan.php)
        // =====================================

        if ($qtyDirect !== null) {

            $newQty = (int) $qtyDirect;

            if ($newQty < 1) {
                // Hapus item
                unset($keranjang[$id]);
                session()->set('keranjang', $keranjang);
                return $this->response->setJSON(['success' => true]);
            }

            if ($newQty > $maxStock) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Melebihi stok tersedia (' . $maxStock . ')'
                ]);
            }

            $keranjang[$id]['qty'] = $newQty;

        // =====================================
        // MODE ?aksi=tambah/kurang (lama)
        // =====================================

        } elseif ($aksi == 'tambah') {

            if ($produk) {

                if ($keranjang[$id]['qty'] < $maxStock) {

                    $keranjang[$id]['qty']++;

                } else {

                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Stock produk habis'
                    ]);
                }
            }

        } elseif ($aksi == 'kurang') {

            $keranjang[$id]['qty']--;

            if ($keranjang[$id]['qty'] < 1) {
                $keranjang[$id]['qty'] = 1;
            }
        }

        // =====================================
        // UPDATE SUBTOTAL
        // =====================================

        $keranjang[$id]['subtotal'] =
            $keranjang[$id]['qty'] *
            $keranjang[$id]['price'];

        // =====================================
        // SAVE SESSION
        // =====================================

        session()->set(
            'keranjang',
            $keranjang
        );

        // =====================================
        // HITUNG TOTAL
        // =====================================

        $total = 0;

        foreach ($keranjang as $item) {

            $total += $item['subtotal'];
        }

        // =====================================
        // RESPONSE JSON
        // =====================================

        return $this->response->setJSON([

            'success' => true,

            'qty' => $keranjang[$id]['qty'],

            'subtotal' => number_format(

                $keranjang[$id]['subtotal'],
                0,
                ',',
                '.'

            ),

            'total' => number_format(

                $total,
                0,
                ',',
                '.'

            )

        ]);
    }

    // =====================================
    // FAILED
    // =====================================

    return $this->response->setJSON([

        'success' => false

    ]);
}

    public function hapusKeranjang($id)
{
    $keranjang = session()->get('keranjang') ?? [];

    if (isset($keranjang[$id])) {

        unset($keranjang[$id]);

    }

    session()->set('keranjang', $keranjang);

    return redirect()->to(base_url('pesanan-user'));
}

    // ============================================================
    // KIRIM PESANAN
    // ============================================================


    public function pesananUser()
{
    $db = db_connect();

    $keranjang = session()->get('keranjang') ?? [];

    $total = 0;

    foreach ($keranjang as $item) {

        $total += $item['subtotal'];
    }

    // =====================================
    // PAYMENT SETTINGS
    // =====================================

    $payment = $db->table('payment_settings')
        ->get()
        ->getRowArray();

    // Client key Midtrans untuk Snap.js
    $midtransConfig = new \Config\Midtrans();

    $data = [

        'keranjang' => $keranjang,

        'total'     => $total,

        'payment'   => $payment,

        'midtrans_client_key' => $midtransConfig->clientKey,

        'midtrans_snap_url'   => $midtransConfig->snapJsUrl(),

    ];

    return view(
        'frontend/pesanan',
        $data
    );
}
    
// === GANTI fungsi kirimPesanan() ===
public function kirimPesanan()
{
    $db        = db_connect();
    $keranjang = session()->get('keranjang') ?? [];

    if (empty($keranjang)) {
        return redirect()->back()->with('error', 'Keranjang masih kosong');
    }

    $total = 0;
    foreach ($keranjang as $item) {
        $total += $item['subtotal'];
    }

    $metodeBayar = $this->request->getPost('metode_bayar');
    $detailBayar = $this->request->getPost('detail_bayar');
    $orderNumber = 'ORD-' . date('YmdHis');

    // INJECT email dari SESSION — bukan dari form — agar selalu match
    $emailUser = session()->get('user_email') 
                 ?? $this->request->getPost('email');

    $db->table('orders')->insert([
        'order_number'      => $orderNumber,
        'customer_name'     => $this->request->getPost('nama_pembeli'),
        'phone'             => $this->request->getPost('no_hp'),
        'customer_email'    => $emailUser,  // ← PERBAIKAN UTAMA
        'address'           => $this->request->getPost('alamat'),
        'total_price'       => $total,
        'status'            => 'pending',
        'notes'             => $this->request->getPost('catatan'),
        'metode_bayar'      => $metodeBayar,
        'detail_bayar'      => $detailBayar,
        'status_pembayaran' => 'Pending'
    ]);

    $orderId = $db->insertID();

    if (!$orderId) {
        return redirect()->back()->with('error', 'Gagal membuat pesanan, coba lagi.');
    }

    foreach ($keranjang as $item) {
        $image = !empty($item['image']) ? $item['image'] : null;

        $db->table('order_items')->insert([
            'order_id'     => $orderId,
            'order_number' => $orderNumber,
            'product_name' => $item['name']     ?? '-',
            'price'        => $item['price']    ?? 0,
            'qty'          => $item['qty']      ?? 1,
            'subtotal'     => $item['subtotal'] ?? 0,
            'image'        => $image
        ]);

        $produk = $db->table('products')
            ->where('id', $item['id'])
            ->get()->getRowArray();

        if ($produk) {
            $stokBaru = max(0, $produk['stock'] - $item['qty']);
            $db->table('products')
                ->where('id', $item['id'])
                ->update(['stock' => $stokBaru]);
        }
    }

    session()->remove('keranjang');

    return redirect()->to(base_url('produk-user'))
        ->with('success', 'Pesanan berhasil dibuat');
}

// =====================================================================
// PROSES PESANAN VIA AJAX - UNTUK INTEGRASI MIDTRANS SNAP
// Dipanggil dari pesanan-sukses.php sebelum membuka Snap popup.
// Logic insert sama seperti kirimPesanan(), tapi:
// - return JSON (bukan redirect)
// - keranjang TIDAK langsung dihapus di sini, dihapus setelah
//   snap popup berhasil dibuka (lihat JS di pesanan-sukses.php)
// =====================================================================
public function prosesPesananAjax()
{
    $db        = db_connect();
    $keranjang = session()->get('keranjang') ?? [];

    if (empty($keranjang)) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Keranjang masih kosong',
        ]);
    }

    $total = 0;
    foreach ($keranjang as $item) {
        $total += $item['subtotal'];
    }

    $orderNumber = 'ORD-' . date('YmdHis');

    $emailUser = session()->get('user_email')
                 ?? $this->request->getPost('customer_email');

    $db->table('orders')->insert([
        'order_number'      => $orderNumber,
        'customer_name'     => $this->request->getPost('customer_name'),
        'phone'             => $this->request->getPost('customer_phone'),
        'customer_email'    => $emailUser,
        'address'           => $this->request->getPost('address'),
        'total_price'       => $total,
        'status'            => 'pending',
        'notes'             => $this->request->getPost('notes'),
        'metode_bayar'      => 'midtrans',
        'detail_bayar'      => null,
        'status_pembayaran' => 'Pending',
    ]);

    $orderId = $db->insertID();

    if (!$orderId) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal membuat pesanan, coba lagi.',
        ]);
    }

    foreach ($keranjang as $item) {
        $image = !empty($item['image']) ? $item['image'] : null;

        $db->table('order_items')->insert([
            'order_id'     => $orderId,
            'order_number' => $orderNumber,
            'product_name' => $item['name']     ?? '-',
            'price'        => $item['price']    ?? 0,
            'qty'          => $item['qty']      ?? 1,
            'subtotal'     => $item['subtotal'] ?? 0,
            'image'        => $image,
        ]);

        $produk = $db->table('products')
            ->where('id', $item['id'])
            ->get()->getRowArray();

        if ($produk) {
            $stokBaru = max(0, $produk['stock'] - $item['qty']);
            $db->table('products')
                ->where('id', $item['id'])
                ->update(['stock' => $stokBaru]);
        }
    }

    // Kosongkan keranjang - order sudah tercatat (status pending)
    session()->remove('keranjang');

    return $this->response->setJSON([
        'success'      => true,
        'order_id'     => $orderId,
        'order_number' => $orderNumber,
        'total_price'  => $total,
    ]);
}

    public function riwayat()
{
    // Cek login
    if (!session()->get('logged_in_user')) {
        return redirect()->to(base_url('login'))
            ->with('error', 'Silakan login dahulu untuk melihat riwayat pesanan');
    }

    $db        = db_connect();
    $emailUser = session()->get('user_email');

    $perPage     = 7;
    $currentPage = (int) ($this->request->getGet('page') ?? 1);
    if ($currentPage < 1) $currentPage = 1;
    $offset = ($currentPage - 1) * $perPage;

    // Total pesanan untuk hitung total halaman
    $total = $db->table('orders')
        ->where('customer_email', $emailUser)
        ->where('hidden_for_user', 0)
        ->countAllResults();

    $totalPages = (int) ceil($total / $perPage);

    $pesananRaw = $db->table('orders')
        ->where('customer_email', $emailUser)
        ->where('hidden_for_user', 0) // filter soft delete
        ->orderBy('created_at', 'DESC')
        ->limit($perPage, $offset)
        ->get()
        ->getResultArray();

    // Decode items dari order_items table per pesanan
    foreach ($pesananRaw as &$p) {

        $items = $db->table('order_items')
            ->where('order_id', $p['id'])
            ->get()
            ->getResultArray();

        if (empty($items)) {
            $items = $db->table('order_items')
                ->where('order_number', $p['order_number'])
                ->get()
                ->getResultArray();
        }

        $p['items_decoded'] = $items;
    }
    unset($p);

    $data['pesanan']     = $pesananRaw;
    $data['total']       = $total;
    $data['totalPages']  = $totalPages;
    $data['currentPage'] = $currentPage;
    $data['perPage']     = $perPage;

    return view('frontend/riwayat', $data);
}

public function cariPesanan()
{
    $db   = db_connect();
    $noHp = $this->request->getPost('no_hp');

    // Jika tidak ada input no_hp, redirect ke riwayat utama
    if (empty($noHp)) {
        return redirect()->to(base_url('riwayat'));
    }

    $pesananRaw = $db->table('orders')
        ->like('phone', $noHp)
        ->orderBy('created_at', 'DESC')
        ->get()
        ->getResultArray();

    // Ambil items dari tabel order_items (bukan dari kolom JSON)
    foreach ($pesananRaw as &$p) {

        $items = $db->table('order_items')
            ->where('order_id', $p['id'])
            ->get()
            ->getResultArray();

        // Fallback pakai order_number jika order_id tidak ketemu
        if (empty($items)) {
            $items = $db->table('order_items')
                ->where('order_number', $p['order_number'])
                ->get()
                ->getResultArray();
        }

        // Fallback terakhir: decode dari kolom JSON lama jika ada
        if (empty($items)) {
            $items = json_decode($p['items'] ?? '[]', true) ?? [];
        }

        $p['items_decoded'] = $items;
    }
    unset($p); // Putus referensi foreach

    $data = [
        'pesanan'    => $pesananRaw,
        'sudah_cari' => true,
        'no_hp'      => $noHp,
    ];

    return view('frontend/riwayat', $data);
}

    // ============================================================
    // DETAIL PESANAN
    // ============================================================

    public function detailPesanan($orderNumber)
    {
        $pesanan = $this->db->table('orders')
            ->where('order_number', $orderNumber)
            ->get()
            ->getRowArray();

        if (!$pesanan) {
            return redirect()->to(base_url('riwayat'));
        }

        $pesanan['items_decoded'] = json_decode($pesanan['items'] ?? '[]', true);

        $data['pesanan'] = $pesanan;

        return view('frontend/detail-pesanan', $data);
    }
    public function register()
{
    return view('frontend/register');
}
    public function saveRegister()
{
    $db = db_connect();

    $db->table('users')->insert([

        'nama'     => $this->request->getPost('nama'),

        'email'    => $this->request->getPost('email'),

        'no_hp'    => $this->request->getPost('no_hp'),

        'password' => password_hash(
            $this->request->getPost('password'),
            PASSWORD_DEFAULT
        )

    ]);

    session()->setFlashdata(
        'success',
        'Registrasi berhasil'
    );

    return redirect()->to(base_url('login'));
}
public function login()
{
    return view('frontend/login');
}

public function loginProcess()
{
    $db = db_connect();

    $email = $this->request->getPost('email');

    $password = $this->request->getPost('password');

    $user = $db->table('users')
        ->where('email', $email)
        ->get()
        ->getRowArray();

    if (!$user) {

        return redirect()->back()
            ->with('error', 'Email tidak ditemukan');
    }

    if (!password_verify($password, $user['password'])) {

        return redirect()->back()
            ->with('error', 'Password salah');
    }

    session()->set([

    'user_id' => $user['id'],

    'user_nama' => $user['nama'],

    'user_email' => $user['email'],

    'logged_in_user' => true

]);

    return redirect()->to(base_url('/'));
}
public function logout()
{
    session()->destroy();

    return redirect()->to(base_url('/'));
}
// ============================================================
// PENGATURAN USER
// ============================================================

// === GANTI fungsi pengaturan() di User.php ===
public function pengaturan()
{
    if (!session()->get('logged_in_user')) {
        return redirect()->to(base_url('login'));
    }
 
    $db     = db_connect();
    $idUser = session()->get('user_id');
 
    $user = $db->table('users')
        ->where('id', $idUser)
        ->get()->getRowArray();
 
    // ─── PAGINATION CONFIG ──────────────────────────────────────
    $perPage     = 4;
    $currentPage = (int) ($this->request->getGet('page') ?? 1);
    if ($currentPage < 1) $currentPage = 1;
    $offset = ($currentPage - 1) * $perPage;
 
    // ─── TOTAL DATA (untuk hitung jumlah halaman) ──────────────
    $totalPesanan = $db->table('orders')
        ->where('customer_email', $user['email'])
        ->where('status', 'success')
        ->countAllResults();
 
    $totalPages = (int) ceil($totalPesanan / $perPage);
 
    // ─── AMBIL DATA HALAMAN INI ─────────────────────────────────
    $pesanan = $db->table('orders')
        ->where('customer_email', $user['email'])
        ->where('status', 'success')
        ->orderBy('created_at', 'DESC')
        ->limit($perPage, $offset)
        ->get()->getResultArray();
 
    $data = [
        'user'         => $user,
        'pesanan'      => $pesanan,
        'totalPesanan' => $totalPesanan,
        'totalPages'   => $totalPages,
        'currentPage'  => $currentPage,
    ];
 
    return view('frontend/pengaturan', $data);
}


// ============================================================
// UPDATE PROFIL USER
// ============================================================

public function updateProfil()
{
    // cek login
    if (!session()->get('logged_in_user')) {

        return redirect()->to(
            base_url('login')
        );
    }

    $db = db_connect();

    $idUser = session()->get('user_id');

    // input
    $nama   = $this->request->getPost('nama');

    $noHp   = $this->request->getPost('no_hp');

    $alamat = $this->request->getPost('alamat');

    // upload foto
    $foto = $this->request->getFile('foto');

    // data update
    $dataUpdate = [

        'nama'   => $nama,

        'no_hp'  => $noHp,

        'alamat' => $alamat

    ];

    // jika ada foto baru
    if ($foto && $foto->isValid() && !$foto->hasMoved()) {

        $namaFoto = $foto->getRandomName();

        $foto->move(
            'uploads/profile',
            $namaFoto
        );

        $dataUpdate['foto'] = $namaFoto;
    }

    // update database
    $db->table('users')
        ->where('id', $idUser)
        ->update($dataUpdate);

    // update session
    session()->set([
        
        'user_nama' => $nama

    ]);

    return redirect()->to(
        base_url('pengaturan-user')
    )->with(
        'success',
        'Profil berhasil diperbarui'
    );
}

// ============================================================
// UPDATE PASSWORD USER
// ============================================================

public function updatePassword()
{
    // cek login
    if (!session()->get('logged_in_user')) {

        return redirect()->to(
            base_url('login')
        );
    }

    $db = db_connect();

    $idUser = session()->get('user_id');

    // input password
    $passwordLama = $this->request->getPost(
        'password_lama'
    );

    $passwordBaru = $this->request->getPost(
        'password_baru'
    );

    $konfirmasi = $this->request->getPost(
        'konfirmasi_password'
    );

    // ambil data user
    $user = $db->table('users')
        ->where('id', $idUser)
        ->get()
        ->getRowArray();

    // cek password lama
    if (
        !password_verify(
            $passwordLama,
            $user['password']
        )
    ) {

        return redirect()->back()->with(
            'error',
            'Password lama salah'
        );
    }

    // cek konfirmasi password
    if ($passwordBaru != $konfirmasi) {

        return redirect()->back()->with(
            'error',
            'Konfirmasi password tidak cocok'
        );
    }

    // update password baru
    $db->table('users')
        ->where('id', $idUser)
        ->update([

            'password' => password_hash(
                $passwordBaru,
                PASSWORD_DEFAULT
            )

        ]);

    return redirect()->to(
        base_url('pengaturan-user')
    )->with(
        'success',
        'Password berhasil diubah'
    );
}
public function prosesLoginUser()
{
    $db = db_connect();

    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    $user = $db->table('users')
        ->where('email', $email)
        ->get()
        ->getRowArray();

    if (!$user) {

        return redirect()->back()
            ->with('error', 'Email tidak ditemukan');
    }

    if (!password_verify($password, $user['password'])) {

        return redirect()->back()
            ->with('error', 'Password salah');
    }

    session()->set([

        'user_id' => $user['id'],
        'user_nama' => $user['nama'],
        'user_email' => $user['email'],
        'logged_in_user' => true

    ]);

    return redirect()->to(base_url('/'));
}
public function logoutUser()
{
    session()->remove([

        'user_id',
        'user_nama',
        'user_email',
        'logged_in_user'

    ]);

    return redirect()->to(base_url('/'));
}
 public function hapusAkun()
    {
        // =========================================
        // CEK LOGIN
        // =========================================
 
        if (!session()->get('logged_in_user')) {
 
            return redirect()->to(
                base_url('login')
            );
        }
 
        $db = db_connect();
 
        $idUser = session()->get('user_id');
 
        // =========================================
        // AMBIL DATA USER
        // =========================================
 
        $user = $db->table('users')
            ->where('id', $idUser)
            ->get()
            ->getRowArray();
 
        if (!$user) {
 
            session()->destroy();
 
            return redirect()->to(base_url('/'));
        }
 
        // =========================================
        // CEK PESANAN AKTIF
        // Berdasarkan customer_email dari tabel orders
        // =========================================
 
        $statusAktif = ['pending', 'processing', 'shipped'];
 
        $pesananAktif = $db->table('orders')
            ->where('customer_email', $user['email'])
            ->whereIn('status', $statusAktif)
            ->countAllResults();
 
        if ($pesananAktif > 0) {
 
            // Ada pesanan aktif — tolak hapus
            return redirect()->to(
                base_url('pengaturan-user')
            )->with(
                'error_hapus',
                'Akun tidak dapat dihapus karena masih memiliki ' .
                $pesananAktif .
                ' pesanan aktif (pending/diproses/dikirim).'
            );
        }
 
        // =========================================
        // TIDAK ADA PESANAN AKTIF — HAPUS AKUN
        // =========================================
 
        // Hapus foto profil jika ada
        if (!empty($user['foto'])) {
 
            $fotoPath = FCPATH . 'uploads/profile/' . $user['foto'];
 
            if (file_exists($fotoPath)) {
 
                unlink($fotoPath);
            }
        }
 
        // Hapus data user dari database
        $db->table('users')
            ->where('id', $idUser)
            ->delete();
 
        // =========================================
        // LOGOUT SESSION
        // =========================================
 
        session()->remove([
            'user_id',
            'user_nama',
            'user_email',
            'logged_in_user',
        ]);
 
        // =========================================
        // REDIRECT KE LANDING PAGE
        // =========================================
 
        session()->setFlashdata(
            'akun_terhapus',
            'Akun Anda telah berhasil dihapus.'
        );
 
        return redirect()->to(base_url('/'));
    }
    public function detailRiwayat($order_number)
{
    $db = db_connect();

    $pesanan = $db->table('orders')
        ->where('order_number', $order_number)
        ->get()
        ->getRowArray();

    if (!$pesanan) {
        return redirect()->to(base_url('riwayat'));
    }

    $items = $db->table('order_items')
        ->where('order_id', $pesanan['id'])
        ->get()
        ->getResultArray();

    if (empty($items)) {
        $items = $db->table('order_items')
            ->where('order_number', $order_number)
            ->get()
            ->getResultArray();
    }

    $midtransConfig = new \Config\Midtrans();

return view('frontend/detail-pesanan', [
    'pesanan'             => $pesanan,
    'items'               => $items,
    'midtrans_client_key' => $midtransConfig->clientKey,
    'midtrans_snap_url'   => $midtransConfig->snapJsUrl(),
]);
}

// ============================================================
// CANCEL PESANAN USER
// ============================================================

// ============================================================
// CANCEL PESANAN USER
// ============================================================

public function cancelPesanan($orderNumber)
{
    // =========================================
    // CEK LOGIN
    // =========================================

    if (!session()->get('logged_in_user')) {
        return redirect()->to(base_url('login'))
            ->with('error', 'Silakan login dahulu');
    }

    $db        = db_connect();
    $emailUser = session()->get('user_email');

    // =========================================
    // AMBIL PESANAN — pastikan milik user ini
    // =========================================

    $pesanan = $db->table('orders')
        ->where('order_number', $orderNumber)
        ->where('customer_email', $emailUser)
        ->get()
        ->getRowArray();

    // =========================================
    // VALIDASI: pesanan harus ada
    // =========================================

    if (!$pesanan) {
        return redirect()->to(base_url('riwayat'))
            ->with('error', 'Pesanan tidak ditemukan');
    }

    // =========================================
    // VALIDASI: hanya boleh cancel jika pending
    // Cegah double restore stock
    // =========================================

    if ($pesanan['status'] !== 'pending') {
        return redirect()->to(base_url('riwayat'))
            ->with('error', 'Pesanan tidak dapat dibatalkan karena status bukan pending');
    }

    // =========================================
    // AMBIL ORDER ITEMS — pakai order_id dulu
    // =========================================

    $items = $db->table('order_items')
        ->where('order_id', $pesanan['id'])
        ->get()
        ->getResultArray();

    // Fallback pakai order_number jika order_id tidak ketemu
    if (empty($items)) {
        $items = $db->table('order_items')
            ->where('order_number', $orderNumber)
            ->get()
            ->getResultArray();
    }

    // =========================================
    // KEMBALIKAN STOK PRODUK
    // Sama persis logika deletePesanan admin
    // =========================================

    foreach ($items as $item) {

        // Cari produk berdasarkan nama produk di order_items
        $produk = $db->table('products')
            ->where('name', $item['product_name'])
            ->get()
            ->getRowArray();

        if ($produk) {

            $stokBaru = $produk['stock'] + $item['qty'];

            $db->table('products')
                ->where('id', $produk['id'])
                ->update([
                    'stock' => $stokBaru
                ]);
        }
    }

    // =========================================
    // UPDATE STATUS ORDER → cancelled
    // Dilakukan SETELAH restore stok berhasil
    // =========================================

    $db->table('orders')
        ->where('order_number', $orderNumber)
        ->where('customer_email', $emailUser)
        ->where('status', 'pending') // double lock — jangan update jika bukan pending
        ->update([
            'status' => 'cancelled'
        ]);

    // =========================================
    // REDIRECT DENGAN FLASH MESSAGE
    // =========================================

    return redirect()->to(base_url('riwayat'))
        ->with('success', 'Pesanan ' . $orderNumber . ' berhasil dibatalkan dan stok produk telah dikembalikan');
}

// ============================================================
// HAPUS RIWAYAT PESANAN USER (SOFT DELETE — data tetap di DB)
// ============================================================

public function hapusRiwayat($orderNumber)
{
    // =========================================
    // CEK LOGIN
    // =========================================

    if (!session()->get('logged_in_user')) {
        return redirect()->to(base_url('login'))
            ->with('error', 'Silakan login dahulu');
    }

    $db        = db_connect();
    $emailUser = session()->get('user_email');

    // =========================================
    // AMBIL PESANAN — pastikan milik user ini
    // =========================================

    $pesanan = $db->table('orders')
        ->where('order_number', $orderNumber)
        ->where('customer_email', $emailUser)
        ->get()
        ->getRowArray();

    // =========================================
    // VALIDASI: pesanan harus ada
    // =========================================

    if (!$pesanan) {
        return redirect()->to(base_url('riwayat'))
            ->with('error', 'Pesanan tidak ditemukan');
    }

    // =========================================
    // VALIDASI: hanya boleh hapus jika cancelled
    // Jangan hapus riwayat pending atau success
    // =========================================

    if ($pesanan['status'] !== 'cancelled') {
        return redirect()->to(base_url('riwayat'))
            ->with('error', 'Hanya pesanan yang sudah dibatalkan yang bisa dihapus dari riwayat');
    }

    // =========================================
    // SOFT DELETE — set hidden_for_user = 1
    // Data tetap ada di DB, admin tetap bisa lihat
    // Stok tidak diubah sama sekali
    // Status tidak diubah sama sekali
    // =========================================

    $db->table('orders')
        ->where('order_number', $orderNumber)
        ->where('customer_email', $emailUser)
        ->where('status', 'cancelled') // double lock keamanan
        ->update([
            'hidden_for_user' => 1
        ]);

    // =========================================
    // REDIRECT DENGAN FLASH MESSAGE
    // =========================================

    return redirect()->to(base_url('riwayat'))
        ->with('success', 'Riwayat pesanan ' . $orderNumber . ' berhasil dihapus dari daftar Anda');
}
}