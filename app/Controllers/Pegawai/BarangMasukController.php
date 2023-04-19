<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use App\Models\BarangPesanan;
use App\Models\SupplierModel;

class BarangMasukController extends BaseController
{
    public function index()
    {
        $barangpesanan = new BarangPesanan();

        $getAllData = $barangpesanan->findAll();
        $data = [
            'title' => 'Barang Masuk',
            'barangpesanan' => $getAllData,
        ];
        return view('pages/pegawai/barang-masuk', $data);
    }
}
