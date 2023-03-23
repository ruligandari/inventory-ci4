<?php

namespace App\Controllers\Supplier;

use App\Controllers\BaseController;
use App\Models\SupplierModel;

class AuthController extends BaseController
{
    public function index()
    {
        return view('pages/supplier/auth/login');
    }

    public function auth()
    {
        $supplier = new SupplierModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $data = $supplier->where('email', $email)->first();
        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'id_supplier' => $data['id_supplier'],
                    'nama' => $data['nama'],
                    'email' => $data['email'],
                    'alamat' => $data['alamat'],
                    'no_hp' => $data['no_hp'],
                    'logged_in' => true,
                ];
                session()->set($ses_data);
                return redirect()->to('supplier/dashboard');
            } else{
                session()->setFlashdata('msg', 'Password salah');
                return redirect()->to('/supplier/login');
            }
        } else {
            session()->setFlashdata('msg', 'Email Tidak Ditemukan');
            return redirect()->to('/supplier/login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/supplier/login');
    }
}
