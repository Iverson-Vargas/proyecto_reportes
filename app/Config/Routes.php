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
$routes->get('/solicitudes', 'ReturnView::solicitudes');
$routes->get('/misSolicitudes', 'ReturnView::misSolicitudes');
$routes->get('/usuarios', 'ReturnView::usuarios');
$routes->get('/cargos', 'ReturnView::cargos');
$routes->get('/departamentos', 'ReturnView::departamentos');
$routes->get('/listadoUsuarios', 'ListarUsuarios::returUsuarios');
$routes->get('/listadoCargo', 'ListarCargos::returnCargos');
$routes->get('/listadoDepartamentos', 'ListarDepartamentos::returnDepartamentos');
$routes->get('/listadoRoles', 'ListarRoles::returnRoles');
$routes->post('/crearUsuario', 'CrearUsers::validarDatos');
$routes->post('/ActualizarUsuario', 'ActualizarUsers::actualizarUsers');
$routes->post('/eliminacion', 'EliminarUsers::eliminacionLogica');
$routes->post('/CrearDepartamento', 'CrearDepartment::validarDepartamento');
$routes->post('/ActualizarDepartamento', 'ActualizarDepartment::updateDepartment');
$routes->post('/EliminarDepartamento', 'EliminarDepartment::eliminarDepartment');
$routes->post('/CrearCargo', 'CrearPosition::validarCargo');
$routes->post('/ActualizarCargo', 'ActualizarPosition::updatePosition');
$routes->post('/EliminarCargo', 'EliminarPosition::eliminarPosition');
$routes->get('/listadoMisSolicitudes', 'ListarMisSolicitudes::returnSolicitudes');
$routes->post('/creandoMisolicitud', 'CreateMiSolicitud::validarMiSolicitud');
$routes->get('/listaFallas', 'ListarFallas::returnFallas');
$routes->get('/listaSolicitudes', 'ListarSolicitudes::returnSolicitudes');
$routes->get('/listaTecnicos', 'ListarTecnicos::returnTecnicos');
$routes->post('/asignarTecnico', 'ActualizarSolicitud::updateSolicitud');
$routes->post('/finalizarSolicitud', 'FinalizarSolicitud::completarSolicitud');
$routes->get('/reporte-1', 'ReturnView::reporte1');
$routes->get('/reporte-2', 'ReturnView::reporte2');
$routes->get('/reporte-3', 'ReturnView::reporte3');
$routes->get('/reporte1TipoFallas', 'ListarTipoFallas::returnTiposFallas');
$routes->get('/reporte2TipoFallasDepartamento', 'ListarTipoFallas::fallasPorDepartamento');
$routes->get('/SolicitudesPorDepartamento', 'ListarSolicitudes::returnSolicitudesPorDepartamento');
$routes->get('/SolicitudesPorTipoFallas', 'ListarSolicitudes::returnSolicitudesPortipoFallas');



