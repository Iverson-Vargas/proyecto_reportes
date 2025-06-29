<?php

namespace App\Controllers;

use App\Models\EliminarUsuario;

class EliminarUsers extends BaseController
{
    public function eliminacionLogica()
    {
        $json = $this->request->getJSON();
        $id = $json->id ?? null;

        if(empty($id))
        {
            return $this->response->setJSON(['success' => false, 'message' => 'Los datos no pueden estar vacíos']);
        }

        $EliminarUsuario = new EliminarUsuario();
        $resultado = $EliminarUsuario->eliminacionLogica($id);
        if($resultado){
               return json_encode(array('success' => true, 'message' => 'Usuario eliminado correctamente'));
        } else {
            return json_encode(array('success' => false, 'message' => 'Error al eliminar el usuario'));
        }
        
    }
}