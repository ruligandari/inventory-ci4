<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangKeluar extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'barang_keluar';
    protected $primaryKey       = 'id_barang_keluar';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
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


    public function getAllDataBarangKeluar()
    {
        $builder = $this->db->table('barang_keluar');
        $builder->join('barang', 'barang.id_barang = barang_keluar.id_barang');
        $query = $builder->get();
        $result = $query->getResultArray();

        return $result;
    }

    public function getDataByDate($id)
    {
        $builder = $this->db->table('barang_keluar');
        $builder->join('barang', 'barang.id_barang = barang_keluar.id_barang');
        $builder->like('tanggal_pesan', $id);
        $query = $builder->get();
        $result = $query->getResultArray();

        return $result;
    }
    public function getDataByMonth($month){
        $builder = $this->db->table('barang_keluar');
        $builder->join('barang', 'barang.id_barang = barang_keluar.id_barang');
        $builder->where('MONTH(tanggal_pesan)', $month);
        $query = $builder->get();
        $result = $query->getResultArray();

        return $result;
    }
    public function getDataByYear($year)
    {
        $builder = $this->db->table('barang_keluar');
        $builder->join('barang', 'barang.id_barang = barang_keluar.id_barang');
        $builder->where('YEAR(tanggal_pesan)', $year);
        $query = $builder->get();
        $result = $query->getResultArray();

        return $result;
    }

    public function getDataByLastThreeMonths()
    {
        $builder = $this->db->table('barang_keluar');
        $builder->join('barang', 'barang.id_barang = barang_keluar.id_barang');

        $currentYear = date('Y');
        $currentMonth = date('m');

        $builder->where('YEAR(tanggal_pesan)', $currentYear);

        // Menentukan bulan awal dan akhir dari tiga bulan terakhir
        $startMonth = $currentMonth - 2;
        $endMonth = $currentMonth;

        // Mengatur filter berdasarkan rentang bulan
        if ($startMonth <= 0) {
            $startMonth = 12 + $startMonth;
            $builder->where('(MONTH(tanggal_pesan) >= ' . $startMonth . ' OR MONTH(tanggal_pesan) <= ' . $endMonth . ')');
        } else {
            $builder->where('MONTH(tanggal_pesan) BETWEEN ' . $startMonth . ' AND ' . $endMonth);
        }

        $builder->orderBy('tanggal_pesan', 'ASC');

        $query = $builder->get();
        $result = $query->getResultArray();

        return $result;
    }
    public function getDataByDay($day){
        $builder = $this->db->table('barang_keluar');
        $builder->join('barang', 'barang.id_barang = barang_keluar.id_barang');
        $builder->where('DATE(tanggal_pesan)', $day);
        $query = $builder->get();
        $result = $query->getResultArray();
    
        return $result;
    }
}