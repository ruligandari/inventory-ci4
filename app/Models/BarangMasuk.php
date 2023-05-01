<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangMasuk extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'barang_masuk';
    protected $primaryKey       = 'id_barang_masuk';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_barang_masuk',
        'id_supplier',
        'id_barang',
        'tanggal_pesan',
        'harga',
        'jumlah',
        'status',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getAllDataBarangMasuk()
    {
        $builder = $this->db->table('barang_masuk');
        $builder->join('barang', 'barang.id_barang = barang_masuk.id_barang');
        $query = $builder->get();
        $result = $query->getResultArray();

        return $result;
    }
}
