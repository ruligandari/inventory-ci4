<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'transaksi';
    protected $primaryKey       = 'id_transaksi';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_transaksi',
        'id_barang',
        'qty',
        'total',
        'tanggal'
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
    public function getAllData()
    {
        $builder = $this->db->table('transaksi');
        $builder->join('barang', 'barang.id_barang = transaksi.id_barang');
        $query = $builder->get();
        $result = $query->getResultArray();

        return $result;
    }
    public function getDataByDate($id)
    {
        $builder = $this->db->table('transaksi');
        $builder->join('barang', 'barang.id_barang = transaksi.id_barang');
        $builder->like('tanggal', $id);
        $query = $builder->get();
        $result = $query->getResultArray();

        return $result;
    }
}