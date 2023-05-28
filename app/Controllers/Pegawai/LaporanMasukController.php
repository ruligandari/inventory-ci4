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

    public function create(){
            $tanggal = $this->request->getVar('month');
            $barang = new BarangMasuk();
            $laporanMasuk = $barang->getDataByDate($tanggal);
            $data = [
                'title' => 'Laporan Barang Masuk',
                'laporanBarang' => $laporanMasuk,
        ];
        return view('layouts/print', $data);
        
        }
        public function unduh()
        {
            $tanggal = $this->request->getVar('month');
            $barang = new BarangMasuk();
            $laporanMasuk = $barang->getDataByDate($tanggal);
            $data = [
                'title' => 'Laporan Barang Keluar',
                'laporanBarang' => $laporanMasuk,
            ];
        
            // Load view into a variable
            $html = view('layouts/print', $data);
        
            // Instantiate Dompdf
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
        
            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper('A4', 'portrait');
        
            // Render the HTML as PDF
            $dompdf->render();
        
            // Generate file name
            $filename = 'laporan_barang_masuk_' . date('Ymd') . '.pdf';
        
            // Force download the PDF file
            $dompdf->stream($filename, ['Attachment' => true]);
        }
}
