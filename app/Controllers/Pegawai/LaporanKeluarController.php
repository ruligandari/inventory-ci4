<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use App\Models\BarangKeluar;

class LaporanKeluarController extends BaseController
{
    public function index()
    {
        $barang = new BarangKeluar();
        $laporanKeluar = $barang->getAllDataBarangKeluar();
        $data = [
            'title' => 'Laporan Masuk',
            'laporanBarang' => $laporanKeluar,
        ];

        return view('pages/pegawai/laporan-barang-keluar', $data);
    }

     public function create()
    {
        $tanggal = $this->request->getVar('month');
        $barang = new BarangKeluar();
        $laporanMasuk = $barang->getDataByDate($tanggal);
        $data = [
            'title' => 'Laporan Barang Keluar',
            'laporanBarang' => $laporanMasuk,
        ];

        return view('layouts/print-keluar', $data);
    }
}
