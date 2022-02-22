<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Challenge');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Challenge::index');
$routes->get('/challenge/index', 'Challenge::index');
$routes->get('/challenge/registrationinfoForm', 'Challenge::register');
$routes->get('/challenge/registrationinfoForm/(:any)', 'Challenge::basicForm/$1');
$routes->post('/challenge/', 'Challenge::insertBasic');
$routes->get('/challenge/roundinfoForm', 'Challenge::roundinfo');
$routes->get('/challenge/awardinfoForm', 'Challenge::awardInfoForm');


$routes->post('/challenge/erase/(:any)', 'Challenge::eraseBasic/$1');
#Authentication
$routes->get('/auth/index', 'Auth::index');
$routes->post('/auth/signin', 'Auth::signin');
$routes->post('/auth/signup', 'Auth::signup');
$routes->get('/auth/verifySign/(:any)', 'Auth::verifySign/$1');
$routes->post('/auth/logout', 'Auth::logout');
#
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
