<?php

namespace App\Controllers;

use App\Models\CrearDepartamentos;

class CrearDepartment extends BaseController
{
    public function validarDepartamento(){

        $json = $this->request->getJSON();
        $nombre = $json->nombre ?? null;

        if(empty($nombre)){
            return $this->response->setJSON(['success' => false, 'mensaje' => 'Los datos no pueden estar vacíos']);
        }

        $dato = [
            'nombre' => $nombre
        ];

        $CrearDepartamento = new CrearDepartamentos();
        $resultado = $CrearDepartamento->insertarDepartamento($dato);

        if ($resultado) {
            return json_encode(array('success' => true, 'message' => 'Departamento creado correctamente'));
        } else {
            return json_encode(array('success' => false, 'message' => 'Error al crear el departamento'));
        }

    }
}