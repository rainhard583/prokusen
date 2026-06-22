<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = db_connect();
        helper(['url', 'form']);
    }

    public function index()
    {
        // ============================================================
        // PRODUK TERSEDIA (aktif)
        // ============================================================
        $stat_produk = $this->db->table('products')
            ->where('is_active', 1)
            ->countAllResults();

        // ============================================================
        // PROYEK SELESAI = total pesanan berstatus success
        // ============================================================
        $stat_proyek_selesai = $this->db->table('orders')
            ->where('status', 'success')
            ->countAllResults();

        // ============================================================
        // PELANGGAN PUAS = jumlah customer unik yang pernah success
        // ============================================================
        $stat_pelanggan = $this->db->table('orders')
            ->select('customer_name')
            ->where('status', 'success')
            ->distinct()
            ->countAllResults();

        // ============================================================
        // SETTING TOKO (nomor WA, telepon, dll)
        // ============================================================
        $settingRows = $this->db->table('site_settings')->get()->getResultArray();
        $setting = [];
        foreach ($settingRows as $row) {
            $setting[$row['key']] = $row['value'];
        }

        $data = [
            'stat_produk'         => $stat_produk,
            'stat_proyek_selesai' => $stat_proyek_selesai,
            'stat_pelanggan'      => $stat_pelanggan,
            'setting'             => $setting,
        ];

        return view('frontend/index', $data);
    }
}