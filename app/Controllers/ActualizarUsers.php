<?php

namespace App\Controllers;

use App\Models\ActualizarUsuario;

class ActualizarUsers extends BaseController
{
    public function actualizarUsers()
    {
        $json = $this->request->getJSON();
        $id = $json->id ?? null;
        $nombres = $json->nombres ?? null;
        $apellidos = $json->apellidos ?? null;
        $cargo_id = $json->cargo_id ?? null;
        $departamento_id = $json->departamento_id ?? null;
        $rol_id = $json->rol_id ?? null;

        if (empty($id) || empty($nombres) || empty($apellidos) || empty($cargo_id) || empty($departamento_id) || empty($rol_id)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Los datos no pueden estar vacíos']);
        }

        $dato = [
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'cargo_id' => $cargo_id,
            'rol_id' => $rol_id,
            'departamento_id' => $departamento_id,
        ];

        $ActualizarUsuario = new ActualizarUsuario();
        $resultado = $ActualizarUsuario->actualizarUsuario($id, $dato);

        if ($resultado) {
            return json_encode(array('success' => true, 'message' => 'Usuario actualizado correctamente'));
        } else {
            return json_encode(array('success' => false, 'message' => 'Error al actualizar el usuario'));
        }
    }
}
