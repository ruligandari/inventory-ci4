<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\DataBarangModel;
use App\Models\TransaksiModel;

class TransaksiController extends BaseController
{
    public function index()
    {
        $transaksiModel = new TransaksiModel();
        $barangModel = new DataBarangModel();
        $data = [
            'title' => 'Data Transaksi',
            'transaksi' => $transaksiModel->getAllData(),
            'barang' => $barangModel->findAll()
        ];
        return view ('pages/pegawai/transaksi',$data);
    }
    public function save(){
        $transaksiModel = new TransaksiModel();
        $barangMasukModel = new BarangMasuk();
        $barangKeluarModel = new BarangKeluar();
        $barangModel = new DataBarangModel();
        $id_barang = $this->request->getVar('id_barang');
        $rowBarang = $barangModel->getDataBarangById($id_barang);
        $qty = $this->request->getVar('qty');
        $data = [
            'id_barang' => $id_barang,
            'qty' => $qty,
            'total' => $rowBarang['harga']*$qty,
            'tanggal' => date('Y-m-d')
        ];
        $transaksiModel->insert($data);
        session()->setFlashdata('success', 'Data berhasil ditambahkan');
        return redirect()->to(base_url('pegawai/transaksi'));
    }
}
