<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Register;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::login');
$routes->get('/login', 'Home::login');
$routes->get('register', 'Register::index');
$routes->post('register/register', 'Register::register');
$routes->get('login', 'Login::index');
$routes->post('login/cek_login', 'Login::cek_login');
$routes->get('logout', 'Login::logout');
$routes->get('dashboard', 'Dashboard::index');
$routes->get('/loker', 'LokerController::index');
$routes->get('/loker/create', 'LokerController::create');
$routes->post('/loker/store', 'LokerController::store');
$routes->get('/loker/edit/(:num)', 'LokerController::edit/$1');
$routes->post('/loker/update/(:num)', 'LokerController::update/$1');
$routes->get('/loker/delete/(:num)', 'LokerController::delete/$1');
$routes->get('/profile', 'Profile::index');
$routes->get('/profile/create', 'Profile::create');
$routes->get('/profile/edit/(:num)', 'Profile::edit/$1');
$routes->post('/profile/update/(:num)', 'Profile::update/$1');
$routes->get('/profile/delete/(:num)', 'Profile::delete/$1');
$routes->post('/profile/store', 'Profile::store');
$routes->get('/jurusan', 'JurusanController::index');
$routes->get('/jurusan/create', 'JurusanController::create');
$routes->post('/jurusan/store', 'JurusanController::store');
$routes->get('/alumni', 'Alumni::index');
$routes->get('/alumni/edit/(:num)', 'Alumni::edit/$1'); 
$routes->post('/alumni/update/(:num)', 'Alumni::update/$1');
$routes->post('/alumni/delete/(:num)', 'Alumni::delete/$1');
$routes->get('/alumni/create', 'Alumni::create');
$routes->post('/alumni/store', 'Alumni::store');