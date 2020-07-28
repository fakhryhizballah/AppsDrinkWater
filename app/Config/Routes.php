<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
//$routes->setDefaultController('Home');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::index');
$routes->get('/regis', 'Auth::regis');
$routes->post('/save', 'Auth::save');
$routes->get('/daftar', 'Auth::daftar');

$routes->get('/history', 'driver::history');
$routes->get('/profil', 'driver::index');
$routes->get('/explore', 'driver::explore');


$routes->get('/home', 'user::index');
$routes->get('/stasiun', 'user::stasiun');
$routes->get('/riwayat', 'user::riwayat');

$routes->get('/driver', 'Admin::driver');
$routes->get('/ptcv', 'Admin::ptcv');

// $routes->get('/admin', 'Admin::index');

// $routes->addRedirect('home/history', 'history');


// $routes->addRedirect('driver/index', 'profil');
//  $routes->group('', ['filter' => 'user'], function ($routes) {
//  	$routes->get('stasiun', 'user::stasiun');
// });


/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
