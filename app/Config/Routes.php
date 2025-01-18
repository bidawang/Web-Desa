<?php

namespace Config;

use App\Controllers\PelayananController;

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

$routes->get('/login-masyarakat', 'AuthMasyarakatController::login');
$routes->post('/login-masyarakat', 'AuthMasyarakatController::authenticate');
$routes->get('/logoutmasyarakat', 'AuthMasyarakatController::logout');

//kelola pelayanan
$routes->get('/pelayanan', 'PelayananController::index');
$routes->get('/pelayanan/syarat/(:num)', 'PelayananController::indexsyarat/$1');
$routes->post('/pelayanan/tambah_syarat/(:num)', 'PelayananController::tambah_syarat/$1');
$routes->post('/pelayanan/hapus_syarat/(:num)', 'PelayananController::delete_syarat/$1');

$routes->get('/pelayanan/create', 'PelayananController::create');
$routes->post('/pelayanan/store', 'PelayananController::store');
$routes->get('/pelayanan/edit/(:num)', 'PelayananController::edit/$1');
$routes->post('/pelayanan/update/(:num)', 'PelayananController::update/$1');
$routes->post('/pelayanan/delete/(:num)', 'PelayananController::delete/$1');


//kelola kartu keluarge
$routes->get('/kk', 'KkController::index');
$routes->get('/kk/create', 'KkController::create');
$routes->post('/kk/store', 'KkController::store');
$routes->get('/kk/edit/(:num)', 'KkController::edit/$1');
$routes->post('/kk/update/(:num)', 'KkController::update/$1');
$routes->post('/kk/delete/(:num)', 'KkController::delete/$1');

//anggota keluarga boy
$routes->group('anggota-keluarga', function ($routes) {
    $routes->get('(:num)', 'AnggotaKKController::index/$1');
    $routes->get('create/(:num)', 'AnggotaKKController::create/$1');
    $routes->post('store/(:num)', 'AnggotaKKController::store/$1');
    $routes->get('edit/(:num)', 'AnggotaKKController::edit/$1');
    $routes->post('update/(:num)', 'AnggotaKKController::update/$1');
    $routes->post('delete/(:num)', 'AnggotaKKController::delete/$1');
});


$routes->group('user-masyarakat', function ($routes) {
    $routes->get('/(:num)', 'UserMasyarakatController::index/$1'); // Menampilkan data berdasarkan id_anggota_keluarga
    $routes->get('create/(:num)', 'UserMasyarakatController::create/$1'); // Form tambah data
    $routes->post('store', 'UserMasyarakatController::store'); // Simpan data
    $routes->get('edit/(:num)', 'UserMasyarakatController::edit/$1'); // Form edit data
    $routes->post('update/(:num)', 'UserMasyarakatController::update/$1'); // Update data
    $routes->post('delete/(:num)', 'UserMasyarakatController::delete/$1'); // Hapus data
});


// landingpage
$routes->get('/village-history', 'ProfileController::VillageHistory');
$routes->get('/vision-mission', 'ProfileController::VisionMission');
$routes->get('/regional-potential', 'ProfileController::RegionalPotential');
$routes->get('/page-gallery', 'GalleryPhotoController::page_gallery');
$routes->get('/page-video-gallery', 'GaleriVideoController::pageVideoGallery');

$routes->get('/page-news', 'BeritaController::pageNews');

$routes->get('/page-produk', 'ProdukController::pageProduk');
$routes->get('/page-produk/(:any)', 'ProdukController::pageDetailProduk/$1');
$routes->get('/page-news/(:any)', 'BeritaController::pageDetailNews/$1');
$routes->get('/page-kontak', 'KontakController::pageKontak');
$routes->get('/page-structure', 'ProfileController::StructureOrganization');


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

$routes->get('/link', 'LinkController::index');
$routes->get('/link/create', 'LinkController::create');
$routes->post('/link/save', 'LinkController::save');
$routes->get('/link/edit/(:num)', 'LinkController::edit/$1');
$routes->post('/link/update/(:num)', 'LinkController::update/$1');
$routes->get('/link/delete/(:num)', 'LinkController::delete/$1');

$routes->get('/kontak', 'KontakController::index');
$routes->get('/kontak/create', 'KontakController::create');
$routes->post('/kontak/save', 'KontakController::save');
$routes->get('/kontak/edit/(:num)', 'KontakController::edit/$1');
$routes->post('/kontak/update/(:num)', 'KontakController::update/$1');
$routes->get('/kontak/delete/(:num)', 'KontakController::delete/$1');

$routes->get('/produk', 'ProdukController::index');
$routes->get('/produk/create', 'ProdukController::create');
$routes->post('/produk/save', 'ProdukController::save');
$routes->get('/produk/edit/(:num)', 'ProdukController::edit/$1');
$routes->post('/produk/update/(:num)', 'ProdukController::update/$1');
$routes->get('/produk/delete/(:num)', 'ProdukController::delete/$1');


//pelayanan masyarakat
$routes->post('/pelayanan-masyarakat/detail', 'PelayananController::detailpelayananmasyarakat' );
$routes->get('/pelayanan-masyarakat', 'PelayananController::pelayananmasyarakat' );

//suret menyuret
$routes->get('/pelayanan-masyarakat/surat/(:num)', 'SuratController::pelayanandomisili/$1' );
// $routes->get('/pelayanan-masyarakat/nikah/(:num)', 'SuratController::pelayanannikah/$1' );
// $routes->get('/pelayanan-masyarakat/kelahiran(:num)', 'SuratController::pelayanankelahiran/$1' );
// $routes->get('/pelayanan-masyarakat/kematian(:num)', 'SuratController::pelayanankematian/$1' );

$routes->get('/surat-create-domisili/(:num)', 'SuratController::suratcreatedomisili/$1' );
$routes->post('/surat-create-domisili/(:num)', 'SuratController::suratcreatedomisili/$1' );
$routes->post('/surat-create-kelahiran/(:num)', 'SuratController::suratcreatekelahiran/$1' );
$routes->post('/surat-create-kematian/(:num)', 'SuratController::suratcreatekematian/$1' );



//View dan Update status surat
$routes->get('/view-domisili', 'SuratController::viewDomisili');
$routes->get('/view-kelahiran', 'SuratController::viewKelahiran');
$routes->get('/view-kematian', 'SuratController::viewKematian');
$routes->get('/view-nikah', 'SuratController::viewNikah');

$routes->post('/pelayanan/update_status/(:num)', 'SuratController::updateStatus/$1');

//kita mengarah ke halaman print
$routes->get('kitaprint_surat/1/(:num)', 'SuratController::print_sk_domisili/$1');
$routes->get('kitaprint_surat/2/(:num)', 'SuratController::print_sk_kelahiran/$1');
$routes->get('kitaprint_surat/3/(:num)', 'SuratController::print_sk_kematian/$1');
// $routes->get('kitaprint_surat/4/(:num)', 'SuratController::print_sp_nikah/$1');


//authentikasi admin
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
