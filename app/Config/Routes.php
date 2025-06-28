<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
// $routes->get('/', 'ValidarSesion::index');
$routes->get('/', 'ReturnView::iniciarSesion');
$routes->get('/welcome', 'Home::welcome');
$routes->get('/inicio', 'ReturnView::inicio');
$routes->get('/salir', 'ControlSalir::salir');
$routes->post('/validarDatos', 'login::validarDatos');
$routes->get('/prueba', 'ReturnView::prueba');


