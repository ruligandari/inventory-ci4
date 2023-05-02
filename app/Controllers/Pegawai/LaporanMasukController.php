<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use App\Models\BarangMasuk;

class LaporanMasukController extends BaseController
{
    public function index()
    {
        $barang = new BarangMasuk();
        $laporanMasuk = $barang->getAllDataBarangMasuk();
        $data = [
            'title' => 'Laporan Masuk',
            'laporanMasuk' => $laporanMasuk,
        ];

        return view('pages/pegawai/laporan-barang-masuk', $data);
    }

    public function create(){
        $tanggal = $this->request->getVar('month');
        $barang = new BarangMasuk();
        $laporanMasuk = $barang->getDataByDate($tanggal);
        $data = [
            'title' => 'Laporan Barang Masuk',
            'laporanBarang' => $laporanMasuk,
        ];

        return view('layouts/print', $data);
    }
}
