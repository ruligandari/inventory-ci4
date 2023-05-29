<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use App\Models\BarangKeluar;
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
        $barangKeluarModel = new BarangKeluar();
        $barangModel = new DataBarangModel();
        $id_barang = $this->request->getVar('id_barang');
        $rowBarang = $barangModel->getDataBarangById($id_barang);
        $qty = $this->request->getVar('qty');
        if ($rowBarang['stok'] < $qty) {
            session()->setFlashdata('error', 'Stok barang tidak mencukupi');
            return redirect()->to(base_url('pegawai/transaksi'));
        }
        $data = [
            'id_barang' => $id_barang,
            'qty' => $qty,
            'total' => $rowBarang['harga']*$qty,
            'tanggal' => date('Y-m-d')
        ];
        $stok = $rowBarang['stok']-$qty;
        $data2 = [
            'id_supplier' => $rowBarang['id_supplier'],
            'id_barang' => $id_barang,
            'tanggal_pesan' => date('Y-m-d'),
            'harga' => $rowBarang['harga']*$qty,
            'jumlah' => $qty,
            'status' => 'Terjual'        
        ];
        $barangKeluarModel->insert($data2);
        $barangModel->updateStok($id_barang,$stok);
        $transaksiModel->insert($data);
        session()->setFlashdata('success', 'Data berhasil ditambahkan');
        return redirect()->to(base_url('pegawai/transaksi'));
        }
}