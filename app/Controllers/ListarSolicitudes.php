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
}