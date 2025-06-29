<?php

namespace App\Controllers;

use App\Models\Cargos;

class ListarCargos extends BaseController
{
    public function returnCargos(){
        $Cargos = new Cargos();
        $datosCargos = $Cargos->traerCargos();
        return json_encode(array('success' => true, 'data' => $datosCargos));
    }
}