<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangPesanan extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'barang_pesanan';
    protected $primaryKey       = 'id_barang_pesanan';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

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

    public function pesananBySupplier($id)
    {
        $builder = $this->db->table('barang_pesanan');
        $builder->where('barang_pesanan.id_supplier', $id);
        return $builder->get()->getResultArray();
    }

    public function updateStatusByIdSupplier($id)
    {
        //update status by id_barang_pesanan where id_supplier

        $builder = $this->db->table('barang_pesanan');
        $builder->set('status', 'Dikirim');
        $builder->where('id_barang_pesanan', $id);
        $builder->update();
    }

}
