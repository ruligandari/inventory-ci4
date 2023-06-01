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
    public function create(){
        $tanggal = $this->request->getVar('month');
        $transaksi = new TransaksiModel();
        $laporanTransaksi = $transaksi->getDataByDate($tanggal);
        $data = [
            'title' => 'Laporan Transaksi',
            'transaksi' => $laporanTransaksi,
    ];
    return view('layouts/print-transaksi', $data);
    
    }
    public function unduh()
{
    $tanggal = $this->request->getVar('month');
    $transaksi = new TransaksiModel();
    $laporanTransaksi = $transaksi->getDataByDate($tanggal);
    $data = [
        'title' => 'Laporan Transaksi',
        'transaksi' => $laporanTransaksi,
    ];

    // Load view into a variable
    $html = view('layouts/print-transaksi', $data);

    // Instantiate Dompdf
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);

    // Set paper size and orientation
    $dompdf->setPaper('A4', 'landscape');

    // Render the HTML as PDF
    $dompdf->render();

    // Generate file name
    $filename = 'laporan_transaksi' . date('Ymd') . '.pdf';

    // Force download the PDF file
    $dompdf->stream($filename, ['Attachment' => true]);
}
}