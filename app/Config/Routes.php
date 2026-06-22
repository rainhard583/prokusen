<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ======================================================
// LANDING PAGE
// ======================================================

$routes->get('/', 'Home::index');


// ======================================================
// AUTH USER
// ======================================================

$routes->get('/login', 'User::login');
$routes->post('/login/process', 'User::loginProcess');

$routes->get('/register', 'User::register');
$routes->post('/register/save', 'User::saveRegister');

$routes->get('/logout-user', 'User::logout');


// ======================================================
// AUTH ADMIN
// ======================================================

$routes->get('/admin/login', 'Admin::adminLogin');
$routes->post('/admin/autentikasi', 'Admin::autentikasi');

$routes->get('/logout-admin', 'Admin::logout');


// ======================================================
// DASHBOARD ADMIN
// ======================================================

$routes->get('/dashboard', 'Admin::dashboard');


// ======================================================
// PRODUK ADMIN
// ======================================================

$routes->get('/produk', 'Admin::produk');

$routes->get('/produk/input', 'Admin::inputProduk');
$routes->post('/produk/save', 'Admin::saveProduk');

$routes->get('/produk/edit/(:num)', 'Admin::editProduk/$1');
$routes->post('/produk/update/(:num)', 'Admin::updateProduk/$1');

$routes->get('/produk/delete/(:num)', 'Admin::deleteProduk/$1');


// ======================================================
// PESANAN ADMIN
// ======================================================

$routes->get('/pesanan', 'Admin::pesanan');

$routes->get('/pesanan/input', 'Admin::inputPesanan');
$routes->post('/pesanan/save', 'Admin::savePesanan');

$routes->get('/pesanan/edit/(:num)', 'Admin::editPesanan/$1');
$routes->post('/pesanan/update/(:num)', 'Admin::updatePesanan/$1');

$routes->get('/pesanan/delete/(:num)', 'Admin::deletePesanan/$1');


// ======================================================
// LAPORAN ADMIN
// ======================================================

$routes->get('/laporan/pesanan', 'Admin::laporan');

$routes->get('/laporan/cetak', 'Admin::cetakLaporan');
$routes->get('/laporan/csv', 'Admin::exportCsv');


// ======================================================
// PROFIL ADMIN
// ======================================================

$routes->get('/profil', 'Admin::profil');

$routes->post('/profil/update', 'Admin::updateProfil');
$routes->post('/profil/password', 'Admin::changePassword');


// ======================================================
// PENGATURAN ADMIN
// ======================================================

$routes->get('/pengaturan', 'Admin::pengaturan');
$routes->post('/pengaturan/update', 'Admin::updatePengaturan');

$routes->post('/pengaturan/admin/save', 'Admin::saveAdmin');
$routes->post('/pengaturan/admin/update', 'Admin::updateAdmin');
$routes->get('/pengaturan/admin/delete/(:num)', 'Admin::deleteAdmin/$1');


// ======================================================
// FRONTEND USER
// ======================================================

$routes->get('/produk-user', 'User::produk');

$routes->get('/produk-user/detail/(:num)', 'User::detailProduk/$1');

$routes->post('/keranjang/tambah/(:num)', 'User::tambahKeranjang/$1');

$routes->get('/pesanan-user', 'User::pesananUser');

$routes->get('/keranjang/update/(:num)', 'User::updateKeranjang/$1');

$routes->get('/keranjang/hapus/(:num)', 'User::hapusKeranjang/$1');

$routes->post('/pesanan/kirim', 'User::kirimPesanan');


// ======================================================
// RIWAYAT PESANAN USER
// ======================================================

$routes->get('/riwayat', 'User::riwayat');

$routes->post('/riwayat/cari', 'User::cariPesanan');

$routes->get('/riwayat/detail/(:segment)', 'User::detailRiwayat/$1');

$routes->post('/riwayat/cancel/(:segment)', 'User::cancelPesanan/$1');

$routes->post('/riwayat/hapus/(:segment)', 'User::hapusRiwayat/$1');


// ======================================================
// MIDTRANS PAYMENT GATEWAY
// ======================================================

// Buat order (AJAX) lalu kembalikan order_id - dipanggil sebelum snap token
$routes->post('/pesanan/proses-ajax', 'User::prosesPesananAjax');

// Ambil Snap Token untuk order tertentu
$routes->post('/payment/snap-token', 'Payment::snapToken');

// Update status dari frontend setelah Snap callback (UX cepat)
$routes->post('/payment/update-status', 'Payment::updateStatusFrontend');

// Notification / Webhook dari Midtrans (TANPA filter session - harus public)
$routes->post('/payment/notification', 'Payment::notification');

// Lanjutkan pembayaran pending dari halaman detail pesanan
$routes->post('/payment/lanjutkan', 'Payment::lanjutkanPembayaran');

// ======================================================
// PENGATURAN USER
// ======================================================

$routes->get('/pengaturan-user', 'User::pengaturan');

$routes->post('/user/update-profil', 'User::updateProfil');

$routes->post('/user/update-password', 'User::updatePassword');

$routes->post('/user/hapus-akun', 'User::hapusAkun');