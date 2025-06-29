<?php 

namespace App\Controllers;

use App\Models\ActualizarCargo;

class ActualizarPosition extends BaseController
{
    public function updatePosition(){
         $json = $this->request->getJSON();
        $id = $json->id ?? null;
        $nombre = $json->nombre ?? null;

        if(empty($id) || empty($nombre)){
            return $this->response->setJSON(['success' => false, 'message' => 'Los datos no pueden estar vacíos']);
        }

        $dato = ['nombre' => $nombre];

        $ActualizarCargo = new ActualizarCargo();
        $resultado = $ActualizarCargo->actualizarCargo($id, $dato);

        if ($resultado) {
            return json_encode(array('success' => true, 'message' => 'Cargo actualizado correctamente'));
        } else {
            return json_encode(array('success' => false, 'message' => 'Error al actualizar el cargo'));
        }
    }
}