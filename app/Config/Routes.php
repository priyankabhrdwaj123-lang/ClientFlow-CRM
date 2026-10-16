<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\CustomerController;

/** @var RouteCollection $routes */
// $routes->get('/', 'Home::index');
$routes->get('/', static function () {
    return redirect()->to(site_url('login'));
});
$routes->get('customers', 'CustomerController::index');
$routes->get('customers/create', 'CustomerController::create');
$routes->post('customers/store', 'CustomerController::store');
$routes->get('customers/(:num)/edit', 'CustomerController::edit/$1');
$routes->post('customers/update/(:num)', 'CustomerController::update/$1');
$routes->post('customers/delete/(:num)', 'CustomerController::delete/$1');
$routes->get('dashboard', 'DashboardController::index');
$routes->get('customers/(:num)', 'CustomerController::show/$1');
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::authenticate');
$routes->get('register', 'AuthController::register');
$routes->post('register', 'AuthController::store');
$routes->get('logout', 'AuthController::logout');
$routes->get('activity-feed', 'ActivityFeedController::index');
$routes->get('calendar', 'CalendarController::index');
$routes->post('calendar/create', 'CalendarController::create');