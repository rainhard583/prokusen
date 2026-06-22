<?php

namespace App\Models;

use CodeIgniter\Model;

class M_pengaturan extends Model
{
    protected $table         = 'site_settings';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['key', 'value'];

    // -------------------------------------------------------
    // getAllSetting() — sudah benar, tidak ada perubahan
    // -------------------------------------------------------
    public function getAllSetting()
    {
        return $this->db->table($this->table)
            ->get()
            ->getResultArray();
    }

    // -------------------------------------------------------
    // BUG LAMA: getSettingByKey() tidak ada padahal berguna
    // PERBAIKAN: ditambahkan supaya bisa ambil 1 setting by key
    // -------------------------------------------------------
    public function getSettingByKey($key)
    {
        $row = $this->db->table($this->table)
            ->where('key', $key)
            ->get()
            ->getRowArray();

        return $row['value'] ?? null;
    }

    // -------------------------------------------------------
    // updateSetting() — sudah benar, tidak ada perubahan
    // -------------------------------------------------------
    public function updateSetting($key, $value)
    {
        return $this->db->table($this->table)
            ->where('key', $key)
            ->update(['value' => $value]);
    }
}
