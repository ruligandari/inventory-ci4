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

// Routes Pegawai
$routes->group('pegawai', ['filter' => 'AuthFilter'], static function ($routes){
    $routes->get('home', 'Pegawai\DashboardController::index');
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

    $routes->get('pesan-barang', 'Pegawai\PesanBarangController::index');
    $routes->get('pesan-barang/create', 'Pegawai\PesanBarangController::create');
    $routes->post('pesan-barang/save', 'Pegawai\PesanBarangController::save');
    
    $routes->get('barang-masuk', 'Pegawai\BarangMasukController::index');
    $routes->post('barang-masuk/save', 'Pegawai\BarangMasukController::save');
    
    $routes->get('barang-keluar', 'Pegawai\BarangKeluarController::index');
    $routes->post('barang-keluar/save', 'Pegawai\BarangKeluarController::save');
});

$routes->get('getDataId','Pegawai\PesanBarangController::getDataBarangById');

$routes->group('supplier', ['filter' => 'AuthSupplierFilter'], static function ($routes){
    $routes->get('dashboard', 'Supplier\DashboardController::index');
    $routes->get('pesanan', 'Supplier\PesananController::index');
    $routes->get('kirim/(:any)', 'Supplier\PesananController::kirim/$1');
    
});

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
