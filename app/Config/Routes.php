<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// routes for admin
$routes->get('/', 'Home::index');
$routes->get('/login', 'Admin\AuthController::index');
$routes->post('/auth', 'Admin\AuthController::auth');
$routes->get('/logout', 'Admin\AuthController::logout');

// routes for supplier
$routes->get('/login/supplier', 'Admin\AuthSupplierController::index');
$routes->post('/login/supplier/auth', 'Admin\AuthSupplierController::auth');
$routes->get('/logout/supplier', 'Admin\AuthSupplierController::logout');

$routes->get('getDataId','Pegawai\PesanBarangController::getDataBarangById');
$routes->get('getDataBarang','Pegawai\DataBarangController::getDataBarang');

// Routes Pegawai
$routes->group('pegawai', ['filter' => 'AuthFilter'], static function ($routes){
    $routes->get('home', 'Pegawai\DashboardController::index');
    
    //Chart Masuk
    $routes->get('home/get_data', 'Pegawai\DashboardController::get_data');
    $routes->get('home/get_data_week','Pegawai\DashboardController::get_data_week');
    $routes->get('home/get_data_hari','Pegawai\DashboardController::get_data_hari');

    //Chart Keluar
    $routes->get('home/get_data_keluar', 'Pegawai\DashboardController::get_data_keluar');
    $routes->get('home/get_data_week_keluar','Pegawai\DashboardController::get_data_week_keluar');
    $routes->get('home/get_data_hari_keluar','Pegawai\DashboardController::get_data_hari_keluar');

    $routes->get('users', 'Pegawai\UsersController::index');
    $routes->get('users/create', 'Pegawai\UsersController::create');
    $routes->post('users/save', 'Pegawai\UsersController::save');
    $routes->get('users/edit/(:num)', 'Pegawai\UsersController::edit/$1');
    $routes->post('users/update/(:num)', 'Pegawai\UsersController::update/$1');
    $routes->post('users/delete/(:num)', 'Pegawai\UsersController::delete/$1');

    $routes->get('supplier', 'Pegawai\SupplierController::index');
    $routes->get('supplier/create', 'Pegawai\SupplierController::create');
    $routes->post('supplier/save', 'Pegawai\SupplierController::save');
    $routes->get('supplier/edit/(:any)', 'Pegawai\SupplierController::edit/$1');
    $routes->post('supplier/delete/(:any)', 'Pegawai\SupplierController::delete/$1');
    $routes->post('supplier/update/(:any)', 'Pegawai\SupplierController::update/$1');

    //Data Barang
    $routes->get('daftar-barang','pegawai\DataBarangController::index');
    $routes->get('daftar-barang/create', 'pegawai\DataBarangController::create');
    $routes->post('daftar-barang/save', 'pegawai\DataBarangController::save');
    $routes->post('daftar-barang/importbyexcel','pegawai\DataBarangController::importbyexcel');
    $routes->get('daftar-barang/edit/(:any)', 'pegawai\DataBarangController::edit/$1');
    $routes->post('daftar-barang/delete/(:any)','pegawai\DataBarangController::delete/$1');
    $routes->post('daftar-barang/update/(:any)', 'pegawai\DataBarangController::update/$1');

    //Transaksi
    $routes->get('transaksi','pegawai\TransaksiController::index');
    $routes->post('transaksi/save','pegawai\TransaksiController::save');
    $routes->get('transaksi/edit/(:any)','pegawai\TransaksiController::edit/$1');
    $routes->post('transaksi/update/(:any)','pegawai\TransaksiController::update/$1');
    $routes->post('transaksi/delete/(:any)','pegawai\TransaksiController::delete/$1');
    
    //Pesan Barang
    $routes->get('pesan-barang', 'Pegawai\PesanBarangController::index');
    $routes->get('pesan-barang/create', 'Pegawai\PesanBarangController::create');
    $routes->post('pesan-barang/save', 'Pegawai\PesanBarangController::save');
    $routes->post('pesan-barang/update/(:any)', 'Pegawai\PesanBarangController::update/$1');
    $routes->post('pesan-barang/konfirmasi/(:any)','Pegawai\PesanBarangController::konfirmasi/$1');
    
    $routes->get('barang-masuk', 'Pegawai\BarangMasukController::index');
    $routes->post('barang-masuk/save', 'Pegawai\BarangMasukController::save');
    $routes->post('barang-masuk/update/(:any)', 'Pegawai\BarangMasukController::update/$1');
    
    $routes->get('barang-keluar', 'Pegawai\BarangKeluarController::index');
    $routes->post('barang-keluar/save', 'Pegawai\BarangKeluarController::save');

    $routes->get('laporan-masuk', 'Pegawai\LaporanMasukController::index');
    $routes->post('laporan-masuk/create', 'Pegawai\LaporanMasukController::create');
    $routes->post('laporan-masuk/unduh','Pegawai\LaporanMasukController::unduh');

    $routes->get('laporan-keluar', 'Pegawai\LaporanKeluarController::index');
    $routes->post('laporan-keluar/create', 'Pegawai\LaporanKeluarController::create');
    $routes->post('laporan-keluar/unduh','Pegawai\LaporanKeluarController::unduh');

    $routes->get('laporan-transaksi', 'Pegawai\LaporanTransaksiController::index');
    $routes->post('laporan-transaksi/create', 'Pegawai\LaporanTransaksiController::create');
    $routes->post('laporan-transaksi/unduh','Pegawai\LaporanTransaksiController::unduh');
});
// Routes Supplier
$routes->group('supplier', ['filter' => 'AuthSupplierFilter'], static function ($routes){
    $routes->get('dashboard', 'Supplier\DashboardController::index');
    $routes->get('pesanan', 'Supplier\PesananController::index');
    $routes->get('kirim/(:any)', 'Supplier\PesananController::kirim/$1');
    
});

// $routes->group('pimpinan', static function ($routes){
//     $routes->get('dashboard', 'Pimpinan\DashboardController::index');
// });

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}