<?php

namespace App\Controllers;

use App\Models\Solicitudes;


class ListarSolicitudes extends BaseController
{
    public function returnSolicitudes() {
        $Solicitudes = new Solicitudes();
        $datos = $Solicitudes->traerSolicitudes();
        return json_encode(array('data' => $datos));

    }

    public function returnSolicitudesPorDepartamento() {
        $SolicitudesPorDepartamento = new Solicitudes();
        $datos = $SolicitudesPorDepartamento->getSolicitudesConDetalles();
        return json_encode(array('data' => $datos));

    }
    public function returnSolicitudesPortipoFallas() {
        $SolicitudesPortipoFallas = new Solicitudes();
        $datos = $SolicitudesPortipoFallas->getSolicitudesConTipoFalla();
        return json_encode(array('data' => $datos));

    }

    
}