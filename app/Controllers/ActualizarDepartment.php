<?php 

namespace App\Controllers;

use App\Models\ActualizarDepartamento;

class ActualizarDepartment extends BaseController
{
    public function updateDepartment()
    {
        $json = $this->request->getJSON();
        $id = $json->id ?? null;
        $nombre = $json->nombre ?? null;

        if(empty($id) || empty($nombre)){
            return $this->response->setJSON(['success' => false, 'message' => 'Los datos no pueden estar vacíos']);
        }

        $dato = ['nombre' => $nombre];

        $ActualizarDepartamento = new ActualizarDepartamento();
        $resultado = $ActualizarDepartamento->actualizarDepartamento($id, $dato);

        if ($resultado) {
            return json_encode(array('success' => true, 'message' => 'Departamento actualizado correctamente'));
        } else {
            return json_encode(array('success' => false, 'message' => 'Error al actualizar el Departamento'));
        }

    }
}