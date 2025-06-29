<?php

namespace App\Controllers;

use App\Models\EliminarCargo;

class EliminarPosition extends BaseController
{

    public function eliminarPosition()
    {
         $json = $this->request->getJSON();
        $id = $json->id ?? null;

        if(empty($id)){
             return $this->response->setJSON(['success' => false, 'message' => 'Los datos no pueden estar vacíos']);
        }

        $EliminarCargo = new EliminarCargo();
        $resultado = $EliminarCargo->eliminarCargo($id);

        if($resultado){
               return json_encode(array('success' => true, 'message' => 'Cargo eliminado correctamente'));
        } else {
            return json_encode(array('success' => false, 'message' => 'Error al eliminar el cargo'));
        }


    }
}