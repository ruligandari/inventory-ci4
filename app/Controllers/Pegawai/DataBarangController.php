<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use App\Models\DataBarangModel;
use App\Helpers\ExcelHelper;
use App\Models\SupplierModel;

class DataBarangController extends BaseController
{
    public function index()
    {
        $barangModel = new DataBarangModel();
        $barang = $barangModel->join('kategori', 'kategori.id_kategori = barang.id_kategori')->findAll();
        $data = [
            'title' => 'Users - Pegawai',
            'barang' => $barang
        ];
        return view('pages/pegawai/data-barang', $data);
    }
    public function getDataBarang(){
        $id_barang = $this->request->getVar('id_barang');
        $barangModel = new DataBarangModel();
        $getData = $barangModel->find($id_barang);
        $data = [
            'harga' => $getData['harga'],
            'stok' => $getData['stok']
        ];
        return $this->response->setJSON($data);
    }

    public function create()
    {
        $supplierModel = new SupplierModel();
        $data = [
            'title' => 'Tambah Data Barang',
            'supplier' => $supplierModel->findAll()
        ];
        return view('pages/pegawai/data-barang-create', $data);
    }
    public function importbyexcel()
    {
        // Mengambil file Excel yang diunggah
        $file = $this->request->getFile('excel_file');

        if ($file->isValid() && !$file->hasMoved()) {
            // Menentukan lokasi penyimpanan sementara file Excel
            $tempPath = WRITEPATH . 'uploads/';

            // Pindahkan file Excel ke lokasi penyimpanan sementara
            $file->move($tempPath);

            // Mengimpor data dari file Excel
            $excelHelper = new Excelhelper();
            $data = $excelHelper->import($tempPath . $file->getName());

            // Simpan data ke database
            $barangModel = new DataBarangModel();
            foreach ($data as $row) {
                $idBarang = $barangModel->generateID();
                $barangModel->insert([
                    'id_barang' => $idBarang,
                    'nama_barang' => $row[0],
                    'id_supplier' => $row[1],
                    'harga' => $row[2]
                ]);
            }

            // Hapus file Excel yang diunggah setelah selesai
            unlink($tempPath . $file->getName());

            // Tampilkan pesan sukses atau lakukan tindakan lainnya
            return redirect()->back()->with('success', 'Data berhasil diimpor.');
        } else {
            // Tampilkan pesan error jika file Excel tidak valid
            return redirect()->back()->with('error', 'Terjadi kesalahan dalam mengunggah file.');
        }
    }

    public function save()
    {
        $nama = $this->request->getVar('nama_barang');
        $id_supplier = $this->request->getVar('id_supplier');
        $stok = $this->request->getVar('stok');
        $harga = $this->request->getVar('harga');

        $barangModel = new DataBarangModel();
        $idBarang = $barangModel->generateID();
        $data = [
            'id_barang' => $idBarang,
            'nama_barang' => $nama,
            'id_supplier' => $id_supplier,
            'stok' => $stok,
            'harga' => $harga
        ];
        if ($data){
            $barangModel->insert($data);
            session()->setFlashdata('success', 'Data berhasil ditambahkan');
            return redirect()->to(base_url('pegawai/daftar-barang'));
        } else {
            session()->setFlashdata('error', 'Data gagal ditambahkan');
            return redirect()->to(base_url('pegawai/daftar-barang/create'));
        }
    }

    public function edit($id)
    {
        $barangModel = new DataBarangModel();
        $user = $barangModel->find($id);

        $data = [
            'title' => 'Edit Data Barang',
            'barang' => $user,
        ];
        return view('pages/pegawai/data-barang-edit', $data);
    }

    public function update($id)
    {
        $nama = $this->request->getVar('nama');
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $users = new UsersModel();
        $data = [
            'nama' => $nama,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ];
        if ($data){
            $users->update($id, $data);
            session()->setFlashdata('success', 'Data berhasil diubah');
            return redirect()->to(base_url('pegawai/users'));
        } else {
            session()->setFlashdata('error', 'Data gagal diubah');
            return redirect()->to(base_url('pegawai/users/edit/'.$id));
        }
    }

    public function delete($id)
    {
        $barang = new DataBarangModel();
        $barang->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to(base_url('pegawai/daftar-barang'));
    }
}