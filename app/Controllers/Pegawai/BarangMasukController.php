<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use App\Models\BarangMasuk;
use App\Models\SupplierModel;

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
}
