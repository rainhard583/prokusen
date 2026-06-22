<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_admin;
use App\Models\M_produk;
use App\Models\M_pesanan;
use App\Models\M_pengaturan;
use App\Models\M_profil;
use Dompdf\Dompdf;

class Admin extends BaseController
{
    protected $adminModel;
    protected $produkModel;
    protected $pesananModel;
    protected $pengaturanModel;
    protected $profilModel;
    public function __construct()
    {
        $this->adminModel      = new M_admin();
        $this->produkModel     = new M_produk();
        $this->pesananModel    = new M_pesanan();
        $this->pengaturanModel = new M_pengaturan();
        $this->profilModel     = new M_profil();
        helper(['url', 'form']);
    }

    // ============================================================
    // CEK SESSION
    // ============================================================

    private function cekSession()
    {
        if (!session()->get('login')) {
            return redirect()->to(base_url('admin/login'));
        }
        return null;
    }


    // ============================================================
    // LOGIN
    // ============================================================

    public function login()
    {
        if (session()->get('login')) {
            return redirect()->to(base_url('dashboard'));
        }
        return view('Backend/Login/login');
    }

    public function autentikasi()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // db_connect() adalah global function CI4, 100% aman dipakai di controller
        $db = db_connect();

        $dataAdmin = $db->table('admins')
            ->where('username', $username)
            ->get()
            ->getRowArray();

        if ($dataAdmin) {

            if ($password == $dataAdmin['password']) {

                session()->set([
                    'id_admin'   => $dataAdmin['id'],
                    'username'   => $dataAdmin['username'],
                    'nama_admin' => $dataAdmin['name'],
                    'login'      => true
                ]);

                return redirect()->to(base_url('dashboard'));

            } else {
                session()->setFlashdata('error', 'Password yang Anda masukkan salah!');
                return redirect()->to(base_url('admin/login'));
            }

        } else {
            session()->setFlashdata('error', 'Username tidak ditemukan!');
            return redirect()->to(base_url('admin/login'));
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('admin/login'));
    }

    // ============================================================
// LOGIN ADMIN PANEL
// ============================================================

public function adminLogin()
{
    if (session()->get('login')) {

        return redirect()->to(base_url('dashboard'));

    }

    return view('Backend/Login/admin_login');
}


    // ============================================================
    // DASHBOARD
    // ============================================================

    public function dashboard()
    {
        $redirect = $this->cekSession();
        if ($redirect) return $redirect;

        $db = db_connect();

        $total_pesanan = $db->table('orders')->countAll();

$row = $db->table('orders')
    ->selectSum('total_price')
    ->where('status', 'success')
    ->get()
    ->getRowArray();

$total_pendapatan = $row['total_price'] ?? 0;

        $total_produk = $db->table('products')->countAll();

        $pesanan_terbaru = $db->table('orders')
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();

        $data = [
            'total_pesanan'    => $total_pesanan,
            'total_pendapatan' => $total_pendapatan,
            'total_produk'     => $total_produk,
            'pesanan_terbaru'  => $pesanan_terbaru,
        ];

        return view('Backend/Dashboard/dashboard_admin', $data);
    }


// ============================================================
// PRODUK
// ============================================================

public function produk()
{
    $redirect = $this->cekSession();
    if ($redirect) return $redirect;

    $keyword  = $this->request->getGet('keyword');
    $kategori = $this->request->getGet('kategori');

    $db = db_connect();

    $builder = $db->table('products');

    // SEARCH
    if ($keyword) {

        $builder->groupStart()
            ->like('name', $keyword)
            ->orLike('description', $keyword)
            ->groupEnd();
    }

    // FILTER KATEGORI
    if ($kategori) {

        $builder->where('category', $kategori);
    }

    $builder->orderBy('id', 'DESC');

    $data['produk'] = $builder
        ->get()
        ->getResultArray();

    return view(
        'Backend/Produk/master-data-produk',
        $data
    );
}

public function inputProduk()
{
    $redirect = $this->cekSession();
    if ($redirect) return $redirect;

    return view('Backend/Produk/input-produk');
}

public function saveProduk()
{
    $redirect = $this->cekSession();
    if ($redirect) return $redirect;

    $data = [

        'name'        => $this->request->getPost('name'),

        'description' => $this->request->getPost('description'),

        'category'    => $this->request->getPost('category'),

        'price'       => $this->request->getPost('price'),

        'stock'       => $this->request->getPost('stock'),

        'is_active'   => $this->request->getPost('is_active'),

        'created_at'  => date('Y-m-d H:i:s'),

        'updated_at'  => date('Y-m-d H:i:s'),
    ];

    $foto = $this->request->getFile('foto');

    if ($foto && $foto->isValid() && !$foto->hasMoved()) {

        $namaFoto = $foto->getRandomName();

        $foto->move(
            ROOTPATH . 'public/uploads/produk',
            $namaFoto
        );

        $data['image'] = $namaFoto;
    }

    $simpan = $this->produkModel
        ->saveDataProduk($data);

    if ($simpan) {

        session()->setFlashdata(
            'success',
            'Data produk berhasil disimpan!'
        );

    } else {

        session()->setFlashdata(
            'error',
            'Gagal menyimpan data produk!'
        );
    }

    return redirect()->to(base_url('produk'));
}

public function editProduk($id)
{
    $redirect = $this->cekSession();
    if ($redirect) return $redirect;

    $db = db_connect();

    $dataProduk = $db->table('products')
        ->where('id', $id)
        ->get()
        ->getRowArray();

    if (!$dataProduk) {

        session()->setFlashdata(
            'error',
            'Data produk tidak ditemukan!'
        );

        return redirect()->to(base_url('produk'));
    }

    $data['detail'] = $dataProduk;

    return view('Backend/Produk/edit-produk', $data);
}

public function updateProduk($id)
{
    $redirect = $this->cekSession();
    if ($redirect) return $redirect;

    $data = [
        'name'        => $this->request->getPost('name'),
        'description' => $this->request->getPost('description'),
        'price'       => $this->request->getPost('price'),
        'stock'       => $this->request->getPost('stock'),
        'category'    => $this->request->getPost('category'),
        'is_active'   => $this->request->getPost('is_active'),
        'updated_at'  => date('Y-m-d H:i:s'),
    ];

    $foto = $this->request->getFile('foto');

    if ($foto && $foto->isValid() && !$foto->hasMoved()) {

        $namaFoto = $foto->getRandomName();

        $foto->move(ROOTPATH . 'public/uploads/produk', $namaFoto);

        $data['image'] = $namaFoto;
    }

    $update = $this->produkModel->updateDataProduk($data, ['id' => $id]);

    if ($update) {

        session()->setFlashdata('success', 'Produk berhasil diupdate');

    } else {

        session()->setFlashdata('error', 'Produk gagal diupdate');

    }

    return redirect()->to(base_url('produk'));
}

public function deleteProduk($id)
{
    $redirect = $this->cekSession();
    if ($redirect) return $redirect;

    $hapus = $this->produkModel
        ->deleteDataProduk(['id' => $id]);

    if ($hapus) {

        session()->setFlashdata(
            'success',
            'Data produk berhasil dihapus!'
        );

    } else {

        session()->setFlashdata(
            'error',
            'Gagal menghapus data produk!'
        );
    }

    return redirect()->to(base_url('produk'));
}


// ============================================================
// PESANAN
// ============================================================

public function pesanan()
{
    $redirect = $this->cekSession();
    if ($redirect) return $redirect;

    $db = db_connect();

    $builder = $db->table('orders');

    // GET INPUT
    $keyword = $this->request->getGet('keyword');

    $status = $this->request->getGet('status');

    // SEARCH
    if ($keyword) {

        $builder->groupStart();

        $builder->like(
            'order_number',
            $keyword
        );

        $builder->orLike(
            'customer_name',
            $keyword
        );

        $builder->groupEnd();
    }

    // FILTER STATUS
    if ($status) {

        $builder->where(
            'status',
            $status
        );
    }

    // ============================================================
    // PAGINATION
    // ============================================================

    $perPage = 8; // jumlah baris per halaman

    $currentPage = (int) ($this->request->getGet('page') ?? 1);

    if ($currentPage < 1) {
        $currentPage = 1;
    }

    // Hitung total data SESUAI filter (reset=false agar where/like tetap
    // terpakai untuk query data di bawah)
    $totalRows = $builder->countAllResults(false);

    $totalPages = (int) ceil($totalRows / $perPage);

    if ($totalPages > 0 && $currentPage > $totalPages) {
        $currentPage = $totalPages;
    }

    $offset = ($currentPage - 1) * $perPage;

    // URUTKAN TERBARU
    $builder->orderBy(
        'created_at',
        'DESC'
    );

    $builder->limit($perPage, $offset);

    $data['pesanan'] = $builder
        ->get()
        ->getResultArray();

    // DATA UNTUK NAVIGASI HALAMAN DI VIEW
    $data['currentPage'] = $currentPage;
    $data['totalPages']  = $totalPages;
    $data['totalRows']   = $totalRows;
    $data['perPage']     = $perPage;
    $data['keyword']     = $keyword;
    $data['status']      = $status;

    return view(
        'Backend/Pesanan/master-data-pesanan',
        $data
    );
}

public function inputPesanan()
{
    $redirect = $this->cekSession();
    if ($redirect) return $redirect;

    $data['produk'] = $this->produkModel->getDataProduk();

    return view('Backend/Pesanan/master-data-input-pesanan', $data);
}

public function savePesanan()
{
    $redirect = $this->cekSession();
    if ($redirect) return $redirect;

    $nomorPesanan = 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -5));

    $data = [
        'order_number'   => $nomorPesanan,
        'customer_name'  => $this->request->getPost('customer_name'),
        'customer_phone' => $this->request->getPost('customer_phone'),
        'customer_email' => $this->request->getPost('customer_email'),
        'address'        => $this->request->getPost('address'),
        'items'          => $this->request->getPost('items'),
        'total_price'    => $this->request->getPost('total_price'),
        'status'         => 'pending',
        'notes'          => $this->request->getPost('notes'),
        'created_at'     => date('Y-m-d H:i:s'),
        'updated_at'     => date('Y-m-d H:i:s'),
    ];

    $simpan = $this->pesananModel->saveDataPesanan($data);

    if ($simpan) {
        session()->setFlashdata('success', 'Data pesanan berhasil disimpan!');
    } else {
        session()->setFlashdata('error', 'Gagal menyimpan data pesanan!');
    }

    return redirect()->to(base_url('pesanan'));
}

public function editPesanan($id)
{
    $redirect = $this->cekSession();
    if ($redirect) return $redirect;

    $db = db_connect();

    $dataPesanan = $db->table('orders')
        ->where('id', $id)
        ->get()
        ->getRowArray();

    if (!$dataPesanan) {
        session()->setFlashdata('error', 'Data pesanan tidak ditemukan!');
        return redirect()->to(base_url('pesanan'));
    }

    $data['detail'] = $dataPesanan;
    $data['produk'] = $this->produkModel->getDataProduk();

    return view('Backend/Pesanan/edit-pesanan', $data);
}

public function updatePesanan($id)
{
    $redirect = $this->cekSession();

    if ($redirect) {
        return $redirect;
    }

    // WHITELIST STATUS — cegah nilai sembarangan masuk ke DB
    $allowedStatus = ['pending', 'success', 'cancelled'];

    $status = strtolower(
        $this->request->getPost('status')
    );

    if (!in_array($status, $allowedStatus)) {
        session()->setFlashdata('error', 'Status tidak valid!');
        return redirect()->to(base_url('pesanan'));
    }

    $this->pesananModel->updateDataPesanan(
        [
            'status'     => $status,
            'updated_at' => date('Y-m-d H:i:s'),
        ],
        ['id' => $id]
    );

    return redirect()->to(base_url('pesanan'));
}

public function deletePesanan($id)
{
    $db = db_connect();

    // =====================================
    // AMBIL ORDER
    // =====================================

    $order = $db->table('orders')
        ->where('id', $id)
        ->get()
        ->getRowArray();

    if (!$order) {

        return redirect()->back();
    }

    // =====================================
    // AMBIL ORDER ITEMS
    // =====================================

    $items = $db->table('order_items')
        ->where('order_id', $id)
        ->get()
        ->getResultArray();

    // =====================================
    // KEMBALIKAN STOK
    // =====================================

    foreach ($items as $item) {

        // cari produk berdasarkan nama
        $produk = $db->table('products')
            ->where('name', $item['product_name'])
            ->get()
            ->getRowArray();

        if ($produk) {

            $stokBaru =
                $produk['stock']
                +
                $item['qty'];

            $db->table('products')
                ->where('id', $produk['id'])
                ->update([

                    'stock' => $stokBaru

                ]);
        }
    }

    // =====================================
    // HAPUS ORDER ITEMS
    // =====================================

    $db->table('order_items')
        ->where('order_id', $id)
        ->delete();

    // =====================================
    // HAPUS ORDER
    // =====================================

    $db->table('orders')
        ->where('id', $id)
        ->delete();

    return redirect()->to(
        base_url('pesanan')
    )->with(
        'success',
        'Pesanan berhasil dihapus'
    );
}

// ============================================================
// LAPORAN
// ============================================================

public function laporan()
{
    $redirect = $this->cekSession();
    if ($redirect) return $redirect;
 
    $db     = db_connect();
    $filter = $this->request->getGet('filter');
 
    // ----------------------------------------------------------
    // BUILDER DASAR — filter waktu
    // ----------------------------------------------------------
    $applyTimeFilter = function (\CodeIgniter\Database\BaseBuilder $builder) use ($filter) {
        if ($filter === 'hari') {
            $builder->where('DATE(created_at)', date('Y-m-d'));
        } elseif ($filter === '7hari') {
            $builder->where('created_at >=', date('Y-m-d H:i:s', strtotime('-7 days')));
        } elseif ($filter === '30hari') {
            $builder->where('created_at >=', date('Y-m-d H:i:s', strtotime('-30 days')));
        }
        return $builder;
    };
 
    // ----------------------------------------------------------
    // 1. TABEL — hanya status SUCCESS, diurutkan terbaru
    // ----------------------------------------------------------
    $builderLaporan = $db->table('orders')->where('status', 'success')->orderBy('created_at', 'DESC');
    $applyTimeFilter($builderLaporan);
    $data['laporan'] = $builderLaporan->get()->getResultArray();
 
    // ----------------------------------------------------------
    // 2. SEMUA PESANAN (untuk pie chart status)
    // ----------------------------------------------------------
    $builderAll = $db->table('orders');
    $applyTimeFilter($builderAll);
    $semuaPesanan = $builderAll->get()->getResultArray();
 
    $countSuccess   = 0;
    $countPending   = 0;
    $countCancelled = 0;
    foreach ($semuaPesanan as $row) {
        if ($row['status'] === 'success')         $countSuccess++;
        elseif ($row['status'] === 'pending')     $countPending++;
        else                                       $countCancelled++;
    }
    $data['pieChart'] = [
        'success'   => $countSuccess,
        'pending'   => $countPending,
        'cancelled' => $countCancelled,
    ];
 
    // ----------------------------------------------------------
    // 3. GRAFIK PENDAPATAN BULANAN (12 bulan terakhir, SUCCESS)
    // ----------------------------------------------------------
    $bulanLabels    = [];
    $bulanPendapatan = [];
    for ($i = 11; $i >= 0; $i--) {
        $tgl   = strtotime("-{$i} months");
        $label = date('M Y', $tgl);   // e.g. "Jan 2025"
        $y     = date('Y', $tgl);
        $m     = date('m', $tgl);
 
        $row = $db->table('orders')
            ->selectSum('total_price', 'total')
            ->where('status', 'success')
            ->where('YEAR(created_at)', $y)
            ->where('MONTH(created_at)', $m)
            ->get()
            ->getRowArray();
 
        $bulanLabels[]     = $label;
        $bulanPendapatan[] = (int)($row['total'] ?? 0);
    }
    $data['grafikBulan']      = $bulanLabels;
    $data['grafikPendapatan'] = $bulanPendapatan;
 
    // ----------------------------------------------------------
    // 4. BAR CHART — 5 PRODUK TERLARIS (dari order_items SUCCESS)
    // ----------------------------------------------------------
    $produkTerlaris = $db->query("
        SELECT oi.product_name, SUM(oi.qty) AS total_qty
        FROM order_items oi
        INNER JOIN orders o ON o.id = oi.order_id
        WHERE o.status = 'success'
        " . ($filter === 'hari'   ? "AND DATE(o.created_at) = '" . date('Y-m-d') . "'" : "")
          . ($filter === '7hari'  ? "AND o.created_at >= '" . date('Y-m-d H:i:s', strtotime('-7 days')) . "'" : "")
          . ($filter === '30hari' ? "AND o.created_at >= '" . date('Y-m-d H:i:s', strtotime('-30 days')) . "'" : "")
        . "
        GROUP BY oi.product_name
        ORDER BY total_qty DESC
        LIMIT 5
    ")->getResultArray();
 
    $data['produkLabel'] = array_column($produkTerlaris, 'product_name');
    $data['produkQty']   = array_column($produkTerlaris, 'total_qty');
 
    // ----------------------------------------------------------
    // 5. PASS FILTER KE VIEW
    // ----------------------------------------------------------
    $data['filter'] = $filter;
 
    return view('Backend/Laporan/laporan-pesanan', $data);
}


// ============================================================
// CETAK LAPORAN PDF
// ============================================================

public function cetakLaporan()
{
    $redirect = $this->cekSession();
    if ($redirect) return $redirect;
 
    $db     = db_connect();
    $filter = $this->request->getGet('filter');
 
    // Hanya SUCCESS
    $builder = $db->table('orders')->where('status', 'success')->orderBy('created_at', 'DESC');
 
    if ($filter === 'hari') {
        $builder->where('DATE(created_at)', date('Y-m-d'));
    } elseif ($filter === '7hari') {
        $builder->where('created_at >=', date('Y-m-d H:i:s', strtotime('-7 days')));
    } elseif ($filter === '30hari') {
        $builder->where('created_at >=', date('Y-m-d H:i:s', strtotime('-30 days')));
    }
 
    $data['laporan']    = $builder->get()->getResultArray();
    $data['total_semua'] = array_sum(array_column($data['laporan'], 'total_price'));
    $data['filter']      = $filter;
 
    $html = view('Backend/Laporan/pdf-laporan', $data);
 
    $dompdf = new \Dompdf\Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream("laporan-penjualan.pdf", ["Attachment" => false]);
}
// ============================================================
// EXPORT CSV
// ============================================================

public function exportCsv()
{
    $redirect = $this->cekSession();
    if ($redirect) return $redirect;
 
    $db     = db_connect();
    $filter = $this->request->getGet('filter');
 
    // Hanya SUCCESS
    $builder = $db->table('orders')->where('status', 'success')->orderBy('created_at', 'DESC');
 
    if ($filter === 'hari') {
        $builder->where('DATE(created_at)', date('Y-m-d'));
    } elseif ($filter === '7hari') {
        $builder->where('created_at >=', date('Y-m-d H:i:s', strtotime('-7 days')));
    } elseif ($filter === '30hari') {
        $builder->where('created_at >=', date('Y-m-d H:i:s', strtotime('-30 days')));
    }
 
    $laporan = $builder->get()->getResultArray();
 
    header('Content-Type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename="laporan-penjualan-' . date('Ymd-His') . '.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');
 
    $file = fopen('php://output', 'w');
 
    // BOM untuk Excel agar bisa baca karakter UTF-8
    fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));
 
    fputcsv($file, ['No Order', 'Customer', 'No HP', 'Email', 'Total (Rp)', 'Status', 'Tanggal']);
 
    foreach ($laporan as $row) {
        fputcsv($file, [
            $row['order_number'],
            $row['customer_name'],
            $row['customer_phone'] ?? $row['phone'] ?? '-',
            $row['customer_email'] ?? '-',
            $row['total_price'],
            $row['status'],
            date('d-m-Y H:i', strtotime($row['created_at'])),
        ]);
    }
 
    fclose($file);
    exit;
}
// ============================================================
// PROFIL ADMIN
// ============================================================

public function profil()
{
    $redirect = $this->cekSession();
    if ($redirect) return $redirect;

    $db      = db_connect();
    $idAdmin = session()->get('id_admin');

    $data['admin'] = $db->table('admins')
        ->where('id', $idAdmin)
        ->get()
        ->getRowArray();

    return view('Backend/Profil/profil-admin', $data);
}

public function updateProfil()
{
    $redirect = $this->cekSession();
    if ($redirect) return $redirect;

    $idAdmin = session()->get('id_admin');

    $data = [

        'name'       => $this->request->getPost('name'),
        'username'   => $this->request->getPost('username'),
        'email'      => $this->request->getPost('email'),
        'phone'      => $this->request->getPost('phone'),
        'gender'     => $this->request->getPost('gender'),
        'birth_date' => $this->request->getPost('birth_date'),
        'address'    => $this->request->getPost('address'),
        'updated_at' => date('Y-m-d H:i:s'),

    ];

    $foto = $this->request->getFile('foto');

    if ($foto && $foto->isValid() && !$foto->hasMoved()) {

        $namaFoto = $foto->getRandomName();

        $foto->move(ROOTPATH . 'public/uploads/profil', $namaFoto);

        $data['foto'] = $namaFoto;
    }

    $update = $this->adminModel->updateDataAdmin(
        $data,
        ['id' => $idAdmin]
    );

    if ($update) {

        session()->set('nama_admin', $data['name']);
        session()->set('username', $data['username']);

        session()->setFlashdata(
            'success',
            'Profil berhasil diupdate!'
        );

    } else {

        session()->setFlashdata(
            'error',
            'Gagal mengupdate profil!'
        );
    }

    return redirect()->to(base_url('profil'));
}

public function changePassword()
{
    $redirect = $this->cekSession();
    if ($redirect) return $redirect;

    $db             = db_connect();
    $idAdmin        = session()->get('id_admin');

    $passwordLama   = $this->request->getPost('password_lama');
    $passwordBaru   = $this->request->getPost('password_baru');
    $konfirmasiPass = $this->request->getPost('konfirmasi_password');

    $dataAdmin = $db->table('admins')
        ->where('id', $idAdmin)
        ->get()
        ->getRowArray();

    // CEK PASSWORD LAMA
    if (!password_verify($passwordLama, $dataAdmin['password'])) {

        session()->setFlashdata(
            'error',
            'Password lama tidak sesuai!'
        );

        return redirect()->to(base_url('profil'));
    }

    // CEK KONFIRMASI PASSWORD
    if ($passwordBaru != $konfirmasiPass) {

        session()->setFlashdata(
            'error',
            'Konfirmasi password baru tidak sesuai!'
        );

        return redirect()->to(base_url('profil'));
    }

    // UPDATE PASSWORD BARU
    $update = $this->adminModel->updateDataAdmin(

        [
            'password'   => password_hash($passwordBaru, PASSWORD_DEFAULT),
            'updated_at' => date('Y-m-d H:i:s')
        ],

        ['id' => $idAdmin]

    );

    if ($update) {

        session()->setFlashdata(
            'success',
            'Password berhasil diubah!'
        );

    } else {

        session()->setFlashdata(
            'error',
            'Gagal mengubah password!'
        );
    }

    return redirect()->to(base_url('profil'));
}


    // ============================================================
    // PENGATURAN
    // ============================================================

    public function pengaturan()
    {
        $redirect = $this->cekSession();
        if ($redirect) return $redirect;

        $db = db_connect();

        $data['admins']  = $db->table('admins')
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResultArray();

        $data['setting'] = $this->pengaturanModel->getAllSetting();

        return view('Backend/Pengaturan/pengaturan-web', $data);
    }

    public function updatePengaturan()
    {
        $redirect = $this->cekSession();
        if ($redirect) return $redirect;

        $settings = [
            'nama_toko'       => $this->request->getPost('nama_toko'),
            'alamat_toko'     => $this->request->getPost('alamat_toko'),
            'no_telp'         => $this->request->getPost('no_telp'),
            'no_wa'           => $this->request->getPost('no_wa'),
            'email_toko'      => $this->request->getPost('email_toko'),
            'jam_operasional' => $this->request->getPost('jam_operasional'),
            'deskripsi'       => $this->request->getPost('deskripsi'),
        ];

        foreach ($settings as $key => $value) {
            $this->pengaturanModel->updateSetting($key, $value);
        }

        session()->setFlashdata('success', 'Pengaturan berhasil disimpan!');
        return redirect()->to(base_url('pengaturan'));
    }

    public function saveAdmin()
    {
        $redirect = $this->cekSession();
        if ($redirect) return $redirect;

        $db = db_connect();

        $username        = $this->request->getPost('username');
        $password        = $this->request->getPost('password');
        $passwordConfirm = $this->request->getPost('password_confirm');

        if ($password !== $passwordConfirm) {
            session()->setFlashdata('error', 'Password dan konfirmasi password tidak sama!');
            return redirect()->to(base_url('pengaturan'));
        }

        if (strlen($password) < 6) {
            session()->setFlashdata('error', 'Password minimal 6 karakter!');
            return redirect()->to(base_url('pengaturan'));
        }

        $cek = $db->table('admins')->where('username', $username)->get()->getRowArray();
        if ($cek) {
            session()->setFlashdata('error', 'Username sudah digunakan, gunakan username lain!');
            return redirect()->to(base_url('pengaturan'));
        }

        $data = [
            'name'       => $this->request->getPost('name'),
            'username'   => $username,
            'email'      => $this->request->getPost('email'),
            'phone'      => $this->request->getPost('phone'),
            'gender'     => $this->request->getPost('gender'),
            'birth_date' => $this->request->getPost('birth_date') ?: null,
            'address'    => $this->request->getPost('address'),
            'role'       => $this->request->getPost('role'),
            'password'   => password_hash($password, PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $simpan = $db->table('admins')->insert($data);

        if ($simpan) {
            session()->setFlashdata('success', 'Admin baru berhasil ditambahkan!');
        } else {
            session()->setFlashdata('error', 'Gagal menambahkan admin!');
        }

        return redirect()->to(base_url('pengaturan'));
    }

    public function updateAdmin()
    {
        $redirect = $this->cekSession();
        if ($redirect) return $redirect;

        $db = db_connect();

        $id       = $this->request->getPost('id');
        $username = $this->request->getPost('username');

        $cek = $db->table('admins')
            ->where('username', $username)
            ->where('id !=', $id)
            ->get()->getRowArray();

        if ($cek) {
            session()->setFlashdata('error', 'Username sudah digunakan admin lain!');
            return redirect()->to(base_url('pengaturan'));
        }

        $data = [
            'name'       => $this->request->getPost('name'),
            'username'   => $username,
            'email'      => $this->request->getPost('email'),
            'phone'      => $this->request->getPost('phone'),
            'gender'     => $this->request->getPost('gender'),
            'birth_date' => $this->request->getPost('birth_date') ?: null,
            'address'    => $this->request->getPost('address'),
            'role'       => $this->request->getPost('role'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            if (strlen($password) < 6) {
                session()->setFlashdata('error', 'Password baru minimal 6 karakter!');
                return redirect()->to(base_url('pengaturan'));
            }
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $update = $db->table('admins')->where('id', $id)->update($data);

        if ($update) {
            session()->setFlashdata('success', 'Data admin berhasil diperbarui!');
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui data admin!');
        }

        return redirect()->to(base_url('pengaturan'));
    }

    public function deleteAdmin($id)
    {
        $redirect = $this->cekSession();
        if ($redirect) return $redirect;

        $db = db_connect();

        $idSession = session()->get('id_admin');
        if ($id == $idSession) {
            session()->setFlashdata('error', 'Tidak bisa menghapus akun yang sedang login!');
            return redirect()->to(base_url('pengaturan'));
        }

        $hapus = $db->table('admins')->where('id', $id)->delete();

        if ($hapus) {
            session()->setFlashdata('success', 'Admin berhasil dihapus!');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus admin!');
        }

        return redirect()->to(base_url('pengaturan'));
    }

}