<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;

class BarangMasukController extends BaseController
{
    public function index()
    {
        $barangpesanan = new BarangMasuk();

        $getAllData = $barangpesanan->getAllDataBarangMasuk();
        $data = [
            'title' => 'Barang Masuk',
            'barangpesanan' => $getAllData,
        ];
        return view('pages/pegawai/barang-masuk', $data);
    }

    public function update($id)
    {
        $barangMasuk = new BarangMasuk();
        $barangMasuk->updateDataStatusById($id);
        $datas = $barangMasuk->getDataById($id);
        $data = [
            'id_supplier' => $datas['id_supplier'],
            'id_barang' => $datas['id_barang'],
            'tanggal_pesan' => $datas['tanggal_pesan'],
            'harga' => $datas['harga'],
            'jumlah' => $datas['jumlah'],
            'status' => "Keluar",
        ];

        $barangKeluar = new BarangKeluar();
        $query = $barangKeluar->insert($data);
        
        if ($query) {
            session()->setFlashdata('success', 'Barang berhasil dikeluarkan');
            return redirect()->to(base_url('pegawai/barang-keluar'));
        } else {
            session()->setFlashdata('error', 'Data pesanan gagal diubah');
            return redirect()->to(base_url('pegawai/barang-masuk'));
        }
    }
}
