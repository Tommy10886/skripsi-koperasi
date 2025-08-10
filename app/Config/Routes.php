<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
$routes->get('/', 'Login::index');
$routes->post('/login', 'Login::login');
$routes->get('/logout', 'Login::logout');

$routes->get('/pengguna', 'Pengguna::index',['filter' => 'authfilter']);
$routes->get('/create_pengguna', 'Pengguna::create',['filter' => 'authfilter']);
$routes->post('/create_action_pengguna', 'Pengguna::create_action',['filter' => 'authfilter']);
$routes->get('/update_pengguna/(:num)', 'Pengguna::update/$1',['filter' => 'authfilter']);
$routes->post('/update_action_pengguna', 'Pengguna::update_action',['filter' => 'authfilter']);
$routes->get('/delete_pengguna/(:num)', 'Pengguna::delete/$1',['filter' => 'authfilter']);


$routes->get('/struktur', 'Struktur::index',['filter' => 'authfilter']);
$routes->get('/create_struktur', 'Struktur::create',['filter' => 'authfilter']);
$routes->post('/create_action_struktur', 'Struktur::create_action',['filter' => 'authfilter']);
$routes->get('/update_struktur/(:num)', 'Struktur::update/$1',['filter' => 'authfilter']);
$routes->post('/update_action_struktur', 'Struktur::update_action',['filter' => 'authfilter']);
$routes->get('/delete_struktur/(:num)', 'Struktur::delete/$1',['filter' => 'authfilter']);

$routes->get('/anggota', 'Anggota::index',['filter' => 'authfilter']);
$routes->get('/create_anggota', 'Anggota::create',['filter' => 'authfilter']);
$routes->post('/create_action_anggota', 'Anggota::create_action',['filter' => 'authfilter']);
$routes->get('/update_anggota/(:num)', 'Anggota::update/$1',['filter' => 'authfilter']);
$routes->post('/update_action_anggota', 'Anggota::update_action',['filter' => 'authfilter']);
$routes->get('/delete_anggota/(:num)', 'Anggota::delete/$1',['filter' => 'authfilter']);
$routes->get('/rincian_anggota/(:num)', 'Anggota::rincian/$1',['filter' => 'authfilter']);
$routes->get('/laporan_rincian_anggota/(:num)', 'Anggota::laporan_rincian/$1',['filter' => 'authfilter']);
$routes->get('/laporan_pinjaman_anggota', 'Anggota::laporan',['filter' => 'authfilter']);

$routes->get('/pinjaman', 'Pinjaman::index',['filter' => 'authfilter']);
$routes->get('/create_pinjaman', 'Pinjaman::create',['filter' => 'authfilter']);
$routes->post('/create_action_pinjaman', 'Pinjaman::create_action',['filter' => 'authfilter']);
$routes->get('/update_pinjaman/(:num)', 'Pinjaman::update/$1',['filter' => 'authfilter']);
$routes->post('/update_action_pinjaman', 'Pinjaman::update_action',['filter' => 'authfilter']);
$routes->get('/delete_pinjaman/(:num)', 'Pinjaman::delete/$1',['filter' => 'authfilter']);
$routes->get('/cetak_simpanan/(:num)', 'Pinjaman::cetak/$1',['filter' => 'authfilter']);

$routes->get('/persetujuan', 'Pinjaman::persetujuan',['filter' => 'authfilter']);
$routes->get('/setuju/(:num)', 'Pinjaman::setuju/$1',['filter' => 'authfilter']);
$routes->get('/tolak/(:num)', 'Pinjaman::tolak/$1',['filter' => 'authfilter']);

$routes->get('/pembayaran', 'Pembayaran::index',['filter' => 'authfilter']);
$routes->get('/create_pembayaran', 'Pembayaran::create',['filter' => 'authfilter']);
$routes->post('/create_action_pembayaran', 'Pembayaran::create_action',['filter' => 'authfilter']);
$routes->get('/update_pembayaran/(:num)', 'Pembayaran::update/$1',['filter' => 'authfilter']);
$routes->post('/update_action_pembayaran', 'Pembayaran::update_action',['filter' => 'authfilter']);
$routes->get('/delete_pembayaran/(:num)', 'Pembayaran::delete/$1',['filter' => 'authfilter']);

$routes->get('/simpanan', 'Simpanan::index',['filter' => 'authfilter']);
$routes->get('/create_simpanan', 'Simpanan::create',['filter' => 'authfilter']);
$routes->post('/create_action_simpanan', 'Simpanan::create_action',['filter' => 'authfilter']);
$routes->get('/update_simpanan/(:num)', 'Simpanan::update/$1',['filter' => 'authfilter']);
$routes->post('/update_action_simpanan', 'Simpanan::update_action',['filter' => 'authfilter']);
$routes->get('/delete_simpanan/(:num)', 'Simpanan::delete/$1',['filter' => 'authfilter']);

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
