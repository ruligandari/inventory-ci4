<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        $uri = service('uri');
        $data = [
            'title' => 'Dashboard - Pegawai',
            'uri' => $uri
        ];
        if (session('role') == '2') {
            return view('pages/pegawai/dashboard', $data);
        } else {
            return redirect()->back();
        }
    }
}
