<?php

namespace App\Controllers;

use App\Models\Roles;

class ListarRoles extends BaseController
{
     public function returnRoles(){
        $Roles = new Roles();
        $datosRoles = $Roles->traerRoles();
        return json_encode(array('success' => true, 'data' => $datosRoles));
    }
}