<?php

namespace App\Controllers\Supplier;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard - Supplier',
        ];
            return view('pages/supplier/dashboard', $data);
        
    }
}
