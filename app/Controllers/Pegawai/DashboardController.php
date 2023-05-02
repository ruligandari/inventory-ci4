<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;

class DashboardController extends BaseController
{
    public function index()
    {
        $uri = service('uri');

        $data = [
            'title' => 'Dashboard - Pegawai',
            'uri' => $uri
        ];
        if (session('logged_in') == true) {
            return view('pages/pegawai/dashboard', $data);
        } else {
            return redirect()->back();
        }
    }
    public function get_data()
    {
        $barangmasuk = new BarangMasuk();
        $data = $barangmasuk->getDataByDate(date('Y-m'));
        echo json_encode($data);
    }

    public function get_data_keluar()
    {
        $barangmasuk = new BarangKeluar();
        $data = $barangmasuk->getDataByDate(date('Y-m'));
        echo json_encode($data);
    }
}
