<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use App\Models\BarangKeluar;
use App\Models\SupplierModel;

class BarangKeluarController extends BaseController
{
    public function index()
    {
        $barangkeluar = new BarangKeluar();

        $getAllData = $barangkeluar->getAllDataBarangKeluar();
        $data = [
            'title' => 'Barang Keluar',
            'barangkeluar' => $getAllData,
        ];
        return view('pages/pegawai/barang-keluar', $data);
    }
}
