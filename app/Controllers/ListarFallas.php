<?php

namespace App\Controllers;

use App\Models\Fallas;

class ListarFallas extends BaseController
{
     public function returnFallas(){
        $Fallas = new Fallas();
        $datos = $Fallas->traeFallas();
        return json_encode(array('success' => true, 'data' => $datos));
    }
}