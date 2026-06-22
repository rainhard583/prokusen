<?php

namespace App\Models;

use CodeIgniter\Model;

class M_profil extends Model
{
    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'name',
        'username',
        'email',
        'phone',
        'gender',
        'birth_date',
        'address',
        'password',
        'created_at',
        'updated_at'
    ];

    public function getProfil($id)
    {
        return $this->db->table($this->table)
            ->where('id', $id)
            ->get()
            ->getRowArray();
    }

    public function updateProfil($data, $where)
    {
        return $this->db->table($this->table)
            ->where($where)
            ->update($data);
    }
}