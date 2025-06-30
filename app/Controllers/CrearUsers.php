<?php

namespace App\Controllers;

use App\Models\CrearUsuario;

class CrearUsers extends BaseController
{

    public function validarDatos()
    {
        $json = $this->request->getJSON();
        $nombres = $json->nombres ?? null;
        $apellidos = $json->apellidos ?? null;
        $cargo_id = $json->cargo_id ?? null;
        $departamento_id = $json->departamento_id ?? null;
        $rol_id = $json->rol_id ?? null;
        $usuario = $json->usuario ?? null;
        $contrasena = $json->contrasena ?? null;

        if (empty($usuario) || empty($contrasena) || empty($nombres) || empty($apellidos) || empty($cargo_id) || empty($departamento_id) || empty($rol_id)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Los datos no pueden estar vacíos']);
        }

        $dato = [
            'usuario' => $usuario,
            'contrasena' => $contrasena,
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'cargo_id' => $cargo_id,
            'rol_id' => $rol_id,
            'departamento_id' => $departamento_id,
            'usuario_estado_id' => 1
        ];

        $CrearUsuario = new CrearUsuario();
        $resultado = $CrearUsuario->insertarUsuario($dato);
        if ($resultado) {
            return json_encode(array('success' => true, 'message' => 'Usuario creado correctamente'));
        } else {
            return json_encode(array('success' => false, 'message' => 'Error al crear el usuario'));
        }
    }
}
