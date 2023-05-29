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
        $tanggal = $this->request->getVar('month');
        $barang = new BarangKeluar();
        $laporanMasuk = $barang->getDataByDate($tanggal);
        $data = [
            'title' => 'Laporan Barang Keluar',
            'laporanBarang' => $laporanMasuk,
        ];

        return view('layouts/print-keluar', $data);
    }
    public function unduh()
{
    $tanggal = $this->request->getVar('month');
    $barang = new BarangKeluar();
    $laporanMasuk = $barang->getDataByDate($tanggal);
    $data = [
        'title' => 'Laporan Barang Keluar',
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
    $filename = 'laporan_barang_keluar_' . date('Ymd') . '.pdf';

    // Force download the PDF file
    $dompdf->stream($filename, ['Attachment' => true]);
}
}