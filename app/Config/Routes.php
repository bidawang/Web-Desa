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
$routes->get('/', 'Home::index');

$routes->get('/video-gallery', 'GaleriVideoController::index');
$routes->get('/create-video-gallery', 'GaleriVideoController::create');
$routes->post('/save-video-gallery', 'GaleriVideoController::save');
$routes->get('/edit-video-gallery/(:num)', 'GaleriVideoController::edit/$1');
$routes->post('/update-video-gallery/(:num)', 'GaleriVideoController::update/$1');
$routes->get('/delete-video-gallery/(:num)', 'GaleriVideoController::delete/$1');


$routes->get('/news', 'BeritaController::index');
$routes->get('/create-news', 'BeritaController::create');
$routes->post('/save-news', 'BeritaController::save');
$routes->get('/news/edit/(:num)', 'BeritaController::edit/$1');
$routes->post('/news/update/(:num)', 'BeritaController::update/$1');
$routes->get('/news/delete/(:num)', 'BeritaController::delete/$1');

$routes->get('/settings', 'PengaturanController::index');
$routes->post('/settings/update', 'PengaturanController::update');




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
