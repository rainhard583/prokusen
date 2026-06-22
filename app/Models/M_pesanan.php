<?php

namespace App\Models;

use CodeIgniter\Model;

class M_pesanan extends Model
{
    protected $table = 'orders';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'order_number',
        'customer_name',
        'customer_phone',
        'customer_email',
        'address',
        'items',
        'total_price',
        'status',
        'notes',
        'created_at',
        'updated_at'
    ];

    // =========================================================
    // GET SEMUA PESANAN
    // =========================================================

    public function getPesanan()
    {
        return $this->db->table($this->table)
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResultArray();
    }

    // =========================================================
    // LAPORAN HARI INI
    // =========================================================

    public function laporanHariIni()
    {
        return $this->db->table($this->table)
            ->where('DATE(created_at)', date('Y-m-d'))
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResultArray();
    }

    // =========================================================
    // LAPORAN 7 HARI
    // =========================================================

    public function laporan7Hari()
    {
        return $this->db->table($this->table)
            ->where(
                'created_at >=',
                date('Y-m-d H:i:s', strtotime('-7 days'))
            )
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResultArray();
    }

    // =========================================================
    // LAPORAN 30 HARI
    // =========================================================

    public function laporan30Hari()
    {
        return $this->db->table($this->table)
            ->where(
                'created_at >=',
                date('Y-m-d H:i:s', strtotime('-30 days'))
            )
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResultArray();
    }

    // =========================================================
    // SAVE
    // =========================================================

    public function saveDataPesanan($data)
    {
        return $this->db->table($this->table)
            ->insert($data);
    }

    // =========================================================
    // UPDATE
    // =========================================================

    public function updateDataPesanan($data, $where)
{
    return $this->db
        ->table('orders')
        ->where($where)
        ->update($data);
}

    // =========================================================
    // DELETE
    // =========================================================

    public function deleteDataPesanan($where)
    {
        return $this->db->table($this->table)
            ->where($where)
            ->delete();
    }
}