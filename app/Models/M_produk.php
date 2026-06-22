<?php

namespace App\Models;

use CodeIgniter\Model;

class M_produk extends Model
{
    protected $table         = 'products';

    protected $primaryKey    = 'id';

    protected $returnType    = 'array';

    protected $allowedFields = [

        'name',

        'description',

        'price',

        'image',

        'category',

        'stock',

        'is_active',

        'created_at',

        'updated_at'
    ];

    public function getDataProduk()
    {
        return $this->db->table($this->table)

            ->select('*')

            ->orderBy('id', 'DESC')

            ->get()

            ->getResultArray();
    }

    public function saveDataProduk($data)
    {
        return $this->db->table($this->table)

            ->insert($data);
    }

    public function updateDataProduk($data, $where)
    {
        return $this->db->table($this->table)

            ->where($where)

            ->update($data);
    }

    public function deleteDataProduk($where)
    {
        return $this->db->table($this->table)

            ->where($where)

            ->delete();
    }

    public function countProduk()
    {
        return $this->db->table($this->table)

            ->countAll();
    }
}