<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'admin\AuthController::index');
$routes->post('auth', 'admin\AuthController::auth');
$routes->get('logout', 'admin\AuthController::logout');

$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('soal', 'admin\SoalController::index');
    $routes->post('soal/store', 'admin\SoalController::store');
    $routes->post('soal/update/(:num)', 'admin\SoalController::update/$1');
    $routes->get('soal/delete/(:num)', 'admin\SoalController::delete/$1');

    $routes->get('siswa', 'admin\SiswaController::index');
});

// routes group api
$routes->group('api', function ($routes) {
    $routes->get('readsoal', 'api\ApiController::index');
    $routes->get('readsoal-by-id/(:num)', 'api\ApiController::readSoalById/$1');
    $routes->get('readsoal-by-id', 'api\ApiController::readSoal');
    $routes->post('readsoal-by-id', 'api\ApiController::readSoalPost');

    $routes->post('readnilai', 'api\ApiController::readNilai');
});
