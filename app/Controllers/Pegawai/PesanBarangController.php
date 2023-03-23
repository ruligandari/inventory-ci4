<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use App\Models\BarangPesanan;
use App\Models\SupplierModel;

class PesanBarangController extends BaseController
{
    public function index()
    {
        $barangpesanan = new BarangPesanan();

        $getAllData = $barangpesanan->findAll();
        $data = [
            'title' => 'Pesan Barang',
            'barangpesanan' => $getAllData,
        ];
        return view('pages/pegawai/pesan-barang', $data);
    }

    public function create()
    {
        $supplier = new SupplierModel();

        $getAllData = $supplier->findAll();
        $data = [
            'title' => 'Pesan Barang',
            'dataSupplier' => $getAllData,
        ];
        return view('pages/pegawai/pesan-barang-create', $data);
    }

    public function save()
    {
        $barangpesanan = new BarangPesanan();
        $tanggal_pesan = $this->request->getVar('tanggal_pesan');
        $id_supplier = $this->request->getVar('id_supplier');
        $nama_barang = $this->request->getVar('nama_barang');
        $jumlah = $this->request->getVar('jumlah');
        $status = 'Dipesan';

        $data = [
            'tanggal_pesan' => $tanggal_pesan,
            'id_supplier' => $id_supplier,
            'nama_barang' => $nama_barang,
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
}
