<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\BarangPesanan;
use App\Models\BarangMasuk;
use App\Models\SupplierModel;

class PesanBarangController extends BaseController
{
    public function index()
    {
        $barangpesanan = new BarangPesanan();
        
        $getAllData = $barangpesanan->getAllData();
        $data = [
            'title' => 'Pesan Barang',
            'barangpesanan' => $getAllData,
            
        ];
        return view('pages/pegawai/pesan-barang', $data);
    }
    
    public function getDataBarangById(){
        $id_barang = $this->request->getVar('id_barang');
        $barangModel = new BarangModel();
        $data_barang = $barangModel->getDataBarangById($id_barang);
        return json_encode($data_barang);
    }

    public function create()
    {
        $supplier = new SupplierModel();
        $barangModel = new BarangModel();
        $getBarangData =$barangModel->findAll();
        $getAllData = $supplier->findAll();
        $data = [
            'title' => 'Pesan Barang',
            'dataSupplier' => $getAllData,
            'barangdata' => $getBarangData,
        ];
        return view('pages/pegawai/pesan-barang-create', $data);
    }

    public function save()
    {
        $barangpesanan = new BarangPesanan();
        $tanggal_pesan = $this->request->getVar('tanggal_pesan');
        $id_supplier = $this->request->getVar('id_supplier');
        $id_barang = $this->request->getVar('id_barang');
        $jumlah = $this->request->getVar('jumlah');
        $status = 'Dipesan';

        $data = [
            'tanggal_pesan' => $tanggal_pesan,
            'id_supplier' => $id_supplier,
            'id_barang' => $id_barang,
            'jumlah' => $jumlah,
            'status' => $status,
        ];

        $query = $barangpesanan->insert($data);

        if ($query) {
            session()->setFlashdata('success', 'Data pesanan berhasil ditambahkan');
            return redirect()->to(base_url('pegawai/pesan-barang'));
        } else {
            session()->setFlashdata('error', 'Data pesanan gagal ditambahkan');
            return redirect()->to(base_url('pegawai/pesan-barang'));
        }

    
    }

    public function update($id)
    {
        $barangpesanan = new BarangPesanan();
        $datas = $barangpesanan->getDataById($id);
        $barangpesanan->updateStatusById($id);
        $data = [
            'id_supplier' => $datas[0]['id_supplier'],
            'id_barang' => $datas[0]['id_barang'],
            'tanggal_pesan' => $datas[0]['tanggal_pesan'],
            'harga' => $datas[0]['harga'],
            'jumlah' => $datas[0]['jumlah'],
            'status' => 'Masuk',
        ];
        $barangmasuk = new BarangMasuk();
        $query = $barangmasuk->insert($data);

        if ($query) {
            session()->setFlashdata('success', 'Data pesanan berhasil dimasukan ke barang masuk');
            return redirect()->to(base_url('pegawai/barang-masuk'));
        } else {
            session()->setFlashdata('error', 'Data pesanan gagal diubah');
            return redirect()->to(base_url('pegawai/pesan-barang'));
        }
    }
}
