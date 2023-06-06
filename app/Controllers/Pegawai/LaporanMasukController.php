<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use App\Models\BarangMasuk;
use Dompdf\Dompdf;

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

    public function create()
    {
        $filter = $this->request->getVar('filter');
        $month = $this->request->getVar('month');
        $year = $this->request->getVar('year');
    
        $barang = new BarangMasuk();
        $laporanMasuk = [];
    
        if ($filter === 'bulan') {
            $laporanMasuk = $barang->getDataByMonth($month);
            $title = "Laporan Barang Masuk Bulan".$month."";
        } else if ($filter === 'tiga-bulan') {
            $laporanMasuk = $barang->getDataByLastThreeMonths();
            $tanggal_sekarang = date('Y-m-d');
            $tigaBulanTerakhir = date('Y-m-d', strtotime('-3 months', strtotime($tanggal_sekarang)));
            $title = "Laporan Barang Masuk 3 Bulan Terakhir <br>".$tanggal_sekarang." Sampai ".$tigaBulanTerakhir."<br>";
        } else if ($filter === 'tahun') {
            $laporanMasuk = $barang->getDataByYear($year);
            $title = "Laporan Barang Masuk Tahun".$year."";
        }
    
        $data = [
            'title' => $title,
            'laporanBarang' => $laporanMasuk,
        ];
    
        return view('layouts/print', $data);
    }
    
    public function unduh()
{
    $filter = $this->request->getVar('filter');
        $month = $this->request->getVar('month');
        $year = $this->request->getVar('year');
    
        $barang = new BarangMasuk();
        $laporanMasuk = [];
    
        if ($filter === 'bulan') {
            $laporanMasuk = $barang->getDataByMonth($month);
            $title = "Laporan Barang Masuk Bulan ".$month."";
        } else if ($filter === 'tiga-bulan') {
            $laporanMasuk = $barang->getDataByLastThreeMonths();
            $tanggal_sekarang = date('Y-m-d');
            $tigaBulanTerakhir = date('Y-m-d', strtotime('-3 months', strtotime($tanggal_sekarang)));
            $title = "Laporan Barang Masuk 3 Bulan Terakhir <br>".$tanggal_sekarang." Sampai ".$tigaBulanTerakhir."<br>";
        } else if ($filter === 'tahun') {
            $laporanMasuk = $barang->getDataByYear($year);
            $title = "Laporan Barang Masuk Tahun ".$year."";
        }
    
        $data = [
            'title' => $title,
            'laporanBarang' => $laporanMasuk,
        ];
    // Load view into a variable
    $html = view('layouts/print', $data);

    // Instantiate Dompdf
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');

    // Render the HTML as PDF
    $dompdf->render();

    // Generate file name
    $filename = 'laporan_barang_masuk' . date('Ymd') . '.pdf';

    // Force download the PDF file
    $dompdf->stream($filename, ['Attachment' => true]);
}
}