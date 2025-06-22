<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
// $routes->get('/', 'ValidarSesion::index');
$routes->get('/', 'Home::iniciarSesion');
$routes->get('/inicio', 'Home::inicio');
$routes->post('/login', 'Home::login');
$routes->get('/salir', 'Home::salir');
$routes->get('/welcome', 'Home::welcome');


