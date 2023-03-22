<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use App\Models\BarangPesanan;

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
}
