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
        if (session('logged_in') == true) {
            return view('pages/pegawai/dashboard', $data);
        } else {
            return redirect()->back();
        }
    }
}
