<?php

namespace App\Controllers;

use App\Models\MisSolicitudes;


class ListarMisSolicitudes extends BaseController
{
    public function returnSolicitudes() {
        $id = $this->request->getGet('id'); // <-- Cambiado a getGet
        $MisSolicitudes = new MisSolicitudes();
        $resultado = $MisSolicitudes->traerMisSolicitudes($id);
        return json_encode(array('data' => $resultado));
    }
}