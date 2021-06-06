<?php

namespace Config;

// Create a new instance of our RouteCollection class.
use App\Controllers\Klijent;

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
$routes->setDefaultController('Gost');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

/*$routes->add('Majstor/promeniPodatke', "Gost::promeniPodatke");
$routes->add('Klijent/promeniPodatke', "Gost::promeniPodatke");*/

//$routes->add("Gost/izlogujSe", 'Klijent::izlogujSe');

$routes->add('prikazMajstora','Klijent::prikazMajstora');

$routes->add('pretrazivanje','Klijent::pretrazivanje');
$routes->add('/prikazUsluga/(:any)','Klijent::prikazUsluga/$1');
$routes->add('prikazMajstora','Klijent::prikazMajstora');

$routes->add('Klijent/pretrazivanje','Klijent::pretrazivanje');
$routes->add('Klijent/prikazUsluga/(:any)','Klijent::prikazUsluga/$1');
$routes->add('Klijent/prikazMajstora','Klijent::prikazMajstora');

// We get a performance increase by specifying the default
// route since we don't have to scan directories .

$routes->get('/', 'Klijent::pretrazivanje');
$routes->get('/Gost', 'Klijent::pretrazivanje');
$routes->get('/Klijent', 'Klijent::pretrazivanje');
$routes->get('/Majstor', 'Majstor::mojeUsluge');
$routes->get('/Admin', 'Admin::pregledMajstora');
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
