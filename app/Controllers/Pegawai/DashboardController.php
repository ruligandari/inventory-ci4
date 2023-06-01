<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\DataBarangModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $uri = service('uri');
        $barangModel = new DataBarangModel();
        $data = [
            'title' => 'Dashboard - Pegawai',
            'uri' => $uri,
            'stok' => $barangModel->where('stok <=', 3)->findAll(),
            'barang' => $barangModel->findAll()
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
    public function get_data_week()
    {
        $barangmasuk = new BarangMasuk();
        $data = $barangmasuk->getDataByMonth(date('Y-m'));
        echo json_encode($data);
    }
    public function get_data_hari()
    {
        $barangmasuk = new BarangMasuk();
        $data = $barangmasuk->getDataByDay(date('Y-m'));
        echo json_encode($data);
    }

    public function get_data_keluar()
    {
        $barangmasuk = new BarangKeluar();
        $data = $barangmasuk->getDataByDate(date('Y-m'));
        echo json_encode($data);
    }
    public function get_data_week_keluar()
    {
        $barangmasuk = new BarangKeluar();
        $data = $barangmasuk->getDataByMonth(date('Y-m'));
        echo json_encode($data);
    }
    public function get_data_hari_keluar()
    {
        $barangmasuk = new BarangKeluar();
        $data = $barangmasuk->getDataByDay(date('Y-m'));
        echo json_encode($data);
    }
}