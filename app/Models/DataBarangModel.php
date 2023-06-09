<?php

namespace App\Models;

use CodeIgniter\Model;

class DataBarangModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'barang';
    protected $primaryKey       = 'id_barang';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_barang',
        'nama_barang',
        'id_supplier',
        'harga'
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

    public function saveProduct($data){
        $this->insertBatch($data);
    }
    public function getDataBarangById($id_barang){
        $builder = $this->db->table('barang');
        $builder->select('*');
        $builder->where('id_barang', $id_barang);
        $query = $builder->get();
        return $query->getRowArray();
    }
    public function getData($id_barang){
        $builder = $this->db->table('barang');
        $builder->select('*');
        $builder->join('kategori', 'barang.id_kategori = kategori.id_kategori');
        $builder->where('id_barang', $id_barang);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getAllData()
    {
        $builder = $this->db->table('barang');
        $builder->join('barang', 'barang.id_barang = barang_keluar.id_barang');
        $query = $builder->get();
        $result = $query->getResultArray();

        return $result;
    }
    public function generateID(){
        $builder = $this->db->table('barang');
        $builder->selectMax('id_barang');
        $query = $builder->get();
        $result = $query->getRowArray();
        $lastID = $result['id_barang'];

        if(!$lastID){
            $newID = 'BR-0001';
        }else{
            $lastNumber = intval(substr($lastID, 4));
            $newNumber = $lastNumber+1;
            $newNumber = str_pad($newNumber, 4, '0', STR_PAD_LEFT);
            $newID = 'BR-'.$newNumber;
        }
        return $newID;
    }
    public function updateStok($id,$stok){
        $builder = $this->db->table('barang');
        $builder->set('stok', $stok);
        $builder->where('id_barang', $id);
        $builder->update();
    }
    public function getStok($id){
        $builder = $this->db->table('barang');
        $builder->select('stok');
        $builder->where('id_barang', $id);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getDataBarang($filter = 'month')
    {
        if ($filter === 'month') {
            // Query untuk filter bulan ini
            $query = $this->db->query("SELECT * FROM barang WHERE MONTH(tanggal_pesan) = MONTH(CURRENT_DATE())");
        } elseif ($filter === 'week') {
            // Query untuk filter minggu ini
            $query = $this->db->query("SELECT * FROM barang WHERE YEARWEEK(tanggal_pesan) = YEARWEEK(CURRENT_DATE())");
        } elseif ($filter === 'item') {
            // Query untuk filter per barang
            $query = $this->db->query("SELECT * FROM barang GROUP BY nama_barang");
        } elseif ($filter === 'day') {
            // Query untuk filter hari ini
            $query = $this->db->query("SELECT * FROM barang WHERE DATE(tanggal_pesan) = CURDATE()");
        }

        return $query->getResultArray();
    }
}