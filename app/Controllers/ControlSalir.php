<?php

namespace App\Controllers;


class ControlSalir extends BaseController
{
    public function salir()
    {
        $session = session();
        $session->destroy();
        return json_encode(array('success' => true, 'message' => 'se cerro la session correctamente'));
    }
}
