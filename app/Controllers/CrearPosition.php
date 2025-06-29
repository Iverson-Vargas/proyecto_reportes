<?php

namespace App\Controllers;

use App\Models\CrearCargo;

class CrearPosition extends BaseController
{
    public function validarCargo(){
        $json = $this->request->getJSON();
        $nombre = $json->nombre ?? null;

        if(empty($nombre)){
            return $this->response->setJSON(['success' => false, 'mensaje' => 'Los datos no pueden estar vacíos']);
        }

         $dato = [
            'nombre' => $nombre
        ];

        $CrearCargo = new CrearCargo();
        $resultado = $CrearCargo->insertarCargo($dato);

        if ($resultado) {
            return json_encode(array('success' => true, 'message' => 'Cargo creado correctamente'));
        } else {
            return json_encode(array('success' => false, 'message' => 'Error al crear el cargo'));
        }
    }
}