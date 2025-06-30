<?php

namespace App\Controllers;

use App\Models\Tecnicos;

class ListarTecnicos extends BaseController
{
     public function returnTecnicos(){
        $Tecnicos= new Tecnicos();
        $datos = $Tecnicos->buscarTecnicos();
        return json_encode(array('success' => true, 'data' => $datos));
    }
}