<?php

use CodeIgniter\Router\RouteCollection;
use Config\Auth;
use App\Controllers\User;

/**
 * @var RouteCollection $routes
 */

// Routes User
$routes->get('/user', 'User::index', ['filter' => 'role:user']);
$routes->get('/contact', 'User::contact', ['filter' => 'role:user']);
$routes->get('/reservasi', 'User::reservasi', ['filter' => 'role:user']);
$routes->get('/transaction', 'User::transaction', ['filter' => 'role:user']);

$routes->get('/create', [User::class, 'create'], ['filter' => 'role:user']);
$routes->post('/pemesanan', [User::class, 'store'], ['filter' => 'role:user']);
$routes->put('/user/(:any)', [User::class, 'update'], ['filter' => 'role:user']);
$routes->get('/edit(:any)', [User::class, 'edit'], ['filter' => 'role:user']);

$routes->put('/refund/(:any)', [User::class, 'processRefund'], ['filter' => 'role:user']);
// $routes->delete('/user/(:any)', [User::class, 'destroy'], ['filter' => 'role:user']);
$routes->match(['get', 'post'], 'sendEmail', 'User::sendEmail', ['filter' => 'role:user']);

// Routes Owner
$routes->get('/owner', 'Owner::index', ['filter' => 'role:owner']);
$routes->get('/pemesanan', 'Owner::pemesanan', ['filter' => 'role:owner']);
$routes->get('/transaksi', 'Owner::transaksi', ['filter' => 'role:owner']);
$routes->get('/staf', 'Owner::staf', ['filter' => 'role:owner']);
$routes->get('/stafedit/(:num)', 'Owner::editStaf/$1', ['filter' => 'role:owner']); // Add this line for editing
$routes->post('/stafedit/(:num)', 'Owner::updateStaf/$1', ['filter' => 'role:owner']);
$routes->get('/staftambah', 'Owner::tambah', ['filter' => 'role:owner']);
$routes->post('/owner/createStaf', 'Owner::createStaf');
$routes->match(['get', 'delete'], '/staf/delete/(:num)', 'Owner::deleteStaf/$1', ['filter' => 'role:owner']);

$routes->get('/kamar', 'Owner::kamar', ['filter' => 'role:owner']);
$routes->get('/kamaredit/(:num)', 'Owner::editKamar/$1');
$routes->post('/updateKamar/(:num)', 'Owner::updateKamar/$1');
$routes->get('/kamartambah', 'Owner::tambahKamar', ['filter' => 'role:owner']);
$routes->match(['get', 'delete'], '/kamar/delete/(:num)', 'Owner::deleteKamar/$1', ['filter' => 'role:owner']);
$routes->post('/owner/createKamar', 'Owner::createKamar');

// Routes Staf
$routes->get('/homestaff', 'HomeStaff::home');
$routes->get('/homestaff/staff', 'HomeStaff::staff');
$routes->get('/homestaff/edit/(:num)', 'HomeStaff::edit/$1');
$routes->get('/homestaff/hapus/(:num)', 'HomeStaff::hapus/$1');
$routes->match(['get', 'post'], '/homestaff/tambah', 'HomeStaff::tambah'); // Use 'match' for both GET and POST requests
$routes->match(['get', 'post'], '/homestaff/update', 'HomeStaff::update'); // Use 'match' for both GET and POST requests

// =======================KAMAR=====================================
$routes->get('/kamarstaff', 'Kamar::index');
$routes->get('/kamartambahstaff', 'Kamar::tambahKamar');

$routes->get('/kamareditstaff/(:num)', 'Kamar::editKamar/$1');
$routes->post('/updateKamarstaff/(:num)', 'Kamar::updateKamar/$1');
$routes->match(['get', 'delete'], '/kamarstaff/delete/(:num)', 'Kamar::deleteKamar/$1');
$routes->post('/createKamar', 'Kamar::createKamar');

// $routes->get('/kamar', 'Owner::kamar');
$routes->post('/kamar/simpan', 'Kamar::simpan');
$routes->post('/kamar/hapus/(:segment)', 'Kamar::hapus/$1');
$routes->get('/kamar/edit/(:segment)', 'Kamar::edit/$1');
$routes->post('/kamar/update/(:segment)', 'Kamar::update/$1');



// ==========================DATA PEMESANAN==================================
$routes->get('/datapemesanan', 'Pemesanan::index');
$routes->post('/pemesanan/simpan', 'Pemesanan::simpan');
$routes->post('/pemesanan/hapus/(:segment)', 'Pemesanan::hapus/$1');
$routes->get('/pemesanan/edit/(:segment)', 'Pemesanan::edit/$1');
$routes->post('/pemesanan/update/(:segment)', 'Pemesanan::update/$1');
$routes->post('/pemesanan/acc/(:segment)', 'Pemesanan::acc/$1');



// Intro
$routes->get('/', 'Home::index');
$routes->get('/login', 'Home::login');
$routes->get('/register', 'Home::register');

$routes->group('', ['namespace' => 'App\Controllers'], static function ($routes) {
    // Load the reserved routes from Auth.php
    $config         = config(Auth::class);
    $reservedRoutes = $config->reservedRoutes;

    // Login/out
    $routes->get($reservedRoutes['login'], 'AuthController::login', ['as' => $reservedRoutes['login']]);
    $routes->post($reservedRoutes['login'], 'AuthController::attemptLogin');
    $routes->get($reservedRoutes['logout'], 'AuthController::logout');

    // Registration
    $routes->get($reservedRoutes['register'], 'AuthController::register', ['as' => $reservedRoutes['register']]);
    $routes->post($reservedRoutes['register'], 'AuthController::attemptRegister');

    // Activation
    $routes->get($reservedRoutes['activate-account'], 'AuthController::activateAccount', ['as' => $reservedRoutes['activate-account']]);
    $routes->get($reservedRoutes['resend-activate-account'], 'AuthController::resendActivateAccount', ['as' => $reservedRoutes['resend-activate-account']]);

    // Forgot/Resets
    $routes->get($reservedRoutes['forgot'], 'AuthController::forgotPassword', ['as' => $reservedRoutes['forgot']]);
    $routes->post($reservedRoutes['forgot'], 'AuthController::attemptForgot');
    $routes->get($reservedRoutes['reset-password'], 'AuthController::resetPassword', ['as' => $reservedRoutes['reset-password']]);
    $routes->post($reservedRoutes['reset-password'], 'AuthController::attemptReset');
});
