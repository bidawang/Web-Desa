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

// landingpage
$routes->get('/village-history', 'ProfileController::VillageHistory');
$routes->get('/vision-mission', 'ProfileController::VisionMission');
$routes->get('/regional-potential', 'ProfileController::RegionalPotential');
$routes->get('/page-gallery', 'GalleryPhotoController::page_gallery');
$routes->get('/page-video-gallery', 'GaleriVideoController::pageVideoGallery');
$routes->get('/page-news', 'BeritaController::pageNews');
$routes->get('/page-news/(:any)', 'BeritaController::pageDetailNews/$1');

$routes->get('/dashboard', 'Home::dashboard');

    // dashboard admin

    $routes->get('/photo', 'GalleryPhotoController::index');
    $routes->add('/photo/create', 'GalleryPhotoController::create');
    $routes->add('/photo/save', 'GalleryPhotoController::save');
    $routes->add('/photo/detail/(:any)', 'GalleryPhotoController::detail/$1');
    $routes->add('/photo/edit/(:num)', 'GalleryPhotoController::edit/$1');
    $routes->add('/photo/update/(:num)', 'GalleryPhotoController::update/$1');
    $routes->get('/photo/delete/(:num)', 'GalleryPhotoController::delete/$1');
    $routes->add('/photo/active/(:num)', 'GalleryPhotoController::active/$1');
    $routes->add('/photo/deactive/(:num)', 'GalleryPhotoController::deactive/$1');

    $routes->get('/video/gallery', 'GaleriVideoController::index');
    $routes->get('/video/create', 'GaleriVideoController::create');
    $routes->post('/video/save', 'GaleriVideoController::save');
    $routes->get('/video/edit/(:num)', 'GaleriVideoController::edit/$1');
    $routes->post('/video/update/(:num)', 'GaleriVideoController::update/$1');
    $routes->get('/video/delete/(:num)', 'GaleriVideoController::delete/$1');

    $routes->get('/news', 'BeritaController::index');
    $routes->get('/news/create', 'BeritaController::create');
    $routes->post('/news/save', 'BeritaController::save');
    $routes->get('/news/edit/(:num)', 'BeritaController::edit/$1');
    $routes->post('/news/update/(:num)', 'BeritaController::update/$1');
    $routes->get('/news/delete/(:num)', 'BeritaController::delete/$1');

    $routes->get('/settings', 'PengaturanController::index');
    $routes->post('/settings/update', 'PengaturanController::update');

    $routes->get('/link', 'linkController::index');
    $routes->get('/link/create', 'LinkController::create');
    $routes->post('/link/save', 'LinkController::save');
    $routes->get('/link/edit/(:num)', 'LinkController::edit/$1');
    $routes->post('/link/update/(:num)', 'LinkController::update/$1');
    $routes->get('/link/delete/(:num)', 'LinkController::delete/$1');

    $routes->get('/login', 'AuthController::login');
    $routes->post('/auth/processLogin', 'AuthController::processLogin');
    $routes->get('/logout', 'AuthController::logout');





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
