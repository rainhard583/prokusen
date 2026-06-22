<?php

namespace App\Models;

use CodeIgniter\Model;

class M_admin extends Model
{
    protected $table         = 'admins';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['name', 'username', 'password', 'email', 'foto', 'updated_at'];

    // -------------------------------------------------------
    // BUG #1 LAMA: method cekLogin() tidak dipakai di controller
    // tapi tetap disimpan untuk jaga-jaga
    // -------------------------------------------------------
    public function cekLogin($username, $password)
    {
        return $this->db->table($this->table)
            ->where('username', $username)
            ->where('password', $password)
            ->get()
            ->getRowArray();
        // PERBAIKAN: return getRowArray() bukan get() mentah
        // supaya langsung bisa dipakai tanpa ->getRowArray() lagi
    }

    // -------------------------------------------------------
    // BUG #2 LAMA: getDataAdmin() return object Result,
    // bukan array — konsisten dipakai ->getResultArray()
    // -------------------------------------------------------
    public function getDataAdmin($where = false)
    {
        if ($where === false) {

            return $this->db->table($this->table)
                ->select('*')
                ->orderBy('name', 'ASC')
                ->get()
                ->getResultArray(); // PERBAIKAN: langsung return array

        } else {

            return $this->db->table($this->table)
                ->where($where)
                ->select('*')
                ->orderBy('name', 'ASC')
                ->get()
                ->getResultArray(); // PERBAIKAN: langsung return array
        }
    }

    // -------------------------------------------------------
    // updateDataAdmin() — sudah benar, tidak ada perubahan
    // -------------------------------------------------------
    public function updateDataAdmin($data, $where)
    {
        return $this->db->table($this->table)
            ->where($where)
            ->update($data);
    }
}
