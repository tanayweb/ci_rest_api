<?php

namespace Config;
// Create a new instance of our RouteCollection class.
use App\Controllers\AuthController;
use App\Controllers\CategoryController;
use App\Controllers\ItemController;
use App\Controllers\PermissionController;
use App\Controllers\RoleController;
use App\Controllers\UserController;
use Couchbase\User;
use org\bovigo\vfs\PermissionsTestCase;

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

$routes->post('/api/login', [AuthController::class, 'login']);

$routes->get('/api/users', [UserController::class, 'index'], ['filter' => 'authFilter']);

$routes->post('/api/store-user', [UserController::class, 'store'],['filter' => 'authFilter']);

$routes->delete('/api/users/(:num)', [[UserController::class, 'delete'], '$1'],['filter' => 'authFilter']);

$routes->post('/api/users/(:num)', [[UserController::class, 'update'], "$1"],['filter' => 'authFilter']);

//role and permissions

$routes->post('/api/roles/(:num)', [[RoleController::class, 'update'], "$1"],['filter' => 'authFilter']);

$routes->delete('/api/roles/(:num)', [[RoleController::class, 'delete'], "$1"],['filter' => 'authFilter']);

$routes->post('/api/roles/(:num)/update-permissions', [[RoleController::class, 'updatePermissions'], "$1"],['filter' => 'authFilter']);

$routes->post('/api/roles', [RoleController::class, 'store'],['filter' => 'authFilter']);

$routes->get('/api/roles', [RoleController::class, 'index'],['filter' => 'authFilter']);


$routes->post('/api/permissions/(:num)', [[PermissionController::class, 'update'], "$1"],['filter' => 'authFilter']);

$routes->delete('/api/permissions/(:num)', [[PermissionController::class, 'delete'], "$1"],['filter' => 'authFilter']);

$routes->post('/api/permissions', [PermissionController::class, 'store'],['filter' => 'authFilter']);

$routes->get('/api/permissions', [PermissionController::class, 'index'],['filter' => 'authFilter']);

$routes->post('/api/store-category', [CategoryController::class, 'store'],['filter' => 'authFilter']);

$routes->post('/api/categories/(:num)', [[CategoryController::class, 'update'], "$1"],[ 'filter' => 'authFilter']);

$routes->delete('/api/categories/(:num)', [[CategoryController::class, 'delete'], "$1"], ['filter' => 'authFilter']);

$routes->get('/api/categories', [CategoryController::class, 'index'],['filter' => 'authFilter']);


$routes->post('/api/items/(:num)', [[ItemController::class, 'update'], "$1"],[ 'filter' => 'authFilter']);

$routes->delete('/api/items/(:num)', [[ItemController::class, 'delete'], "$1"], ['filter' => 'authFilter']);

$routes->post('/api/store-item', [ItemController::class, 'store'], ['filter' => 'authFilter']);

$routes->get('/api/items', [ItemController::class, 'index'], ['filter' => 'authFilter']);

$routes->get('/api/users/(:num)', "UserController::get_user/$1",['filter' => 'authFilter']);

$routes->get('/', 'Home::index');

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