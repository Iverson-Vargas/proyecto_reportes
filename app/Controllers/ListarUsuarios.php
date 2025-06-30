<?php

namespace App\Controllers;

use App\Models\Usuarios;


class ListarUsuarios extends BaseController
{
    public function returUsuarios() {
        $Usuarios = new Usuarios();
        $datosUsuarios = $Usuarios->traerUsuarios();
        //return $this->response->setJSON(['success' => true, 'data' => $datosUsuarios]);
        //return json_encode(array('success' => true, 'data' => $datosUsuarios));
        return json_encode(array('data' => $datosUsuarios));

    }
}