<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use App\Models\TransaksiModel;
use Dompdf\Dompdf;
class LaporanTransaksiController extends BaseController
{
    public function index()
    {
        $transaksi = new TransaksiModel();
        $laporanTransaksi = $transaksi->getAllData();
        $data = [
            'title' => 'Laporan Transaksi',
            'transaksi' => $laporanTransaksi,
        ];

        return view('pages/pegawai/laporan-transaksi', $data);
    }
    public function create()
    {
        $filter = $this->request->getVar('filter');
        $month = $this->request->getVar('month');
        $year = $this->request->getVar('year');
    
        $barang = new TransaksiModel();
        $laporanMasuk = [];
    
        if ($filter === 'bulan') {
            $laporanMasuk = $barang->getDataByMonth($month);
            $title = "Laporan Transaksi Bulan ".$month."";
        } else if ($filter === 'tiga-bulan') {
            $laporanMasuk = $barang->getDataByLastThreeMonths();
            $tanggal_sekarang = date('Y-m-d');
            $tigaBulanTerakhir = date('Y-m-d', strtotime('-3 months', strtotime($tanggal_sekarang)));
            $title = "Laporan Transaksi 3 Bulan Terakhir <br>".$tanggal_sekarang." Sampai ".$tigaBulanTerakhir."<br>";
        } else if ($filter === 'tahun') {
            $laporanMasuk = $barang->getDataByYear($year);
            $title = "Laporan Transaksi Tahun ".$year."";
        }
    
        $data = [
            'title' => $title,
            'laporanBarang' => $laporanMasuk,
        ];
    
        return view('layouts/print-keluar', $data);
    }
    
    public function unduh()
{
    $filter = $this->request->getVar('filter');
        $month = $this->request->getVar('month');
        $year = $this->request->getVar('year');
    
        $barang = new TransaksiModel();
        $laporanMasuk = [];
    
        if ($filter === 'bulan') {
            $laporanMasuk = $barang->getDataByMonth($month);
            $title = "Laporan Transaksi Bulan ".$month."";
        } else if ($filter === 'tiga-bulan') {
            $laporanMasuk = $barang->getDataByLastThreeMonths();
            $tanggal_sekarang = date('Y-m-d');
            $tigaBulanTerakhir = date('Y-m-d', strtotime('-3 months', strtotime($tanggal_sekarang)));
            $title = "Laporan Transaksi 3 Bulan Terakhir <br>".$tanggal_sekarang." Sampai ".$tigaBulanTerakhir."<br>";
        } else if ($filter === 'tahun') {
            $laporanMasuk = $barang->getDataByYear($year);
            $title = "Laporan Transaksi Tahun ".$year."";
        }
    
        $data = [
            'title' => $title,
            'laporanBarang' => $laporanMasuk,
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
    $filename = 'laporan_transaksi' . date('Ymd') . '.pdf';

    // Force download the PDF file
    $dompdf->stream($filename, ['Attachment' => true]);
}
}