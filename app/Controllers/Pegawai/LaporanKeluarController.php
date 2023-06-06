<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use App\Models\BarangKeluar;
use Dompdf\Dompdf;
class LaporanKeluarController extends BaseController
{
    public function index()
    {
        $barang = new BarangKeluar();
        $laporanKeluar = $barang->getAllDataBarangKeluar();
        $data = [
            'title' => 'Laporan Keluar',
            'laporanBarang' => $laporanKeluar,
        ];

        return view('pages/pegawai/laporan-barang-keluar', $data);
    }

    public function create()
    {
        $filter = $this->request->getVar('filter');
        $month = $this->request->getVar('month');
        $year = $this->request->getVar('year');
    
        $barang = new BarangKeluar();
        $laporanKeluar = [];
    
        if ($filter === 'bulan') {
            $laporanKeluar = $barang->getDataByMonth($month);
            $title = "Laporan Barang Keluar Bulan ".$month."";
        } else if ($filter === 'tiga-bulan') {
            $laporanKeluar = $barang->getDataByLastThreeMonths();
            $tanggal_sekarang = date('Y-m-d');
            $tigaBulanTerakhir = date('Y-m-d', strtotime('-3 months', strtotime($tanggal_sekarang)));
            $title = "Laporan Barang Keluar 3 Bulan Terakhir <br>".$tanggal_sekarang." Sampai ".$tigaBulanTerakhir."<br>";
        } else if ($filter === 'tahun') {
            $laporanKeluar = $barang->getDataByYear($year);
            $title = "Laporan Barang Keluar Tahun ".$year."";
        }
    
        $data = [
            'title' => $title,
            'laporanBarang' => $laporanKeluar,
        ];
    
        return view('layouts/print-keluar', $data);
    }
    
    public function unduh()
{
    $filter = $this->request->getVar('filter');
        $month = $this->request->getVar('month');
        $year = $this->request->getVar('year');
    
        $barang = new BarangKeluar();
        $laporanKeluar = [];
    
        if ($filter === 'bulan') {
            $laporanKeluar = $barang->getDataByMonth($month);
            $title = "Laporan Barang Keluar Bulan".$month."";
        } else if ($filter === 'tiga-bulan') {
            $laporanKeluar = $barang->getDataByLastThreeMonths();
            $tanggal_sekarang = date('Y-m-d');
            $tigaBulanTerakhir = date('Y-m-d', strtotime('-3 months', strtotime($tanggal_sekarang)));
            $title = "Laporan Barang Keluar 3 Bulan Terakhir yaitu dari tanggal ".$tanggal_sekarang." sampai tanggal ".$tigaBulanTerakhir."";
        } else if ($filter === 'tahun') {
            $laporanKeluar = $barang->getDataByYear($year);
            $title = "Laporan Barang Keluar Tahun".$year."";
        }
    
        $data = [
            'title' => $title,
            'laporanBarang' => $laporanKeluar,
        ];
    // Load view into a variable
    $html = view('layouts/print-keluar', $data);

    // Instantiate Dompdf
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');

    // Render the HTML as PDF
    $dompdf->render();

    // Generate file name
    $filename = 'laporan_barang_keluar_' . date('Ymd') . '.pdf';

    // Force download the PDF file
    $dompdf->stream($filename, ['Attachment' => true]);
}
}