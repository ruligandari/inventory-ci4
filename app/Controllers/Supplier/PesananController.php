<?php

namespace App\Controllers\Supplier;

use App\Controllers\BaseController;
use App\Models\BarangPesanan;

class PesananController extends BaseController
{
    public function index()
    {
        $pesanan = new BarangPesanan();
        $getDataBySupplier = $pesanan->pesananBySupplier(session()->get('id_supplier'));
        $data = [
            'title' => 'Pesanan',
            'pesanan' => $getDataBySupplier,
        ];
        return view('pages/supplier/pesanan', $data);
    }

    public function kirim($id)
    {
        $pesanan = new BarangPesanan();
        $pesanan->updateStatusByIdSupplier($id);
        return redirect()->to('/supplier/pesanan');
    }
}
