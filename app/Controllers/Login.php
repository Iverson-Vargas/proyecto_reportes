<?php

namespace App\Controllers;

use App\Models\Usuarios;

class Login extends BaseController
{

    public function validarDatos()
    {
        $json = $this->request->getJSON();
        $usuario = $json->usuario ?? null;
        $contrasena = $json->contrasena ?? null;

        if (empty($usuario) || empty($contrasena)) {
            return json_encode(array('success' => false, 'mensaje' => 'el usuario o contraseña no pueden estar vacio'));
        }

        $Usuario = new Usuarios();
        $datosUsuarios = $Usuario->getUsuario($usuario);

        if (count($datosUsuarios) > 0) {
            if ($contrasena == $datosUsuarios[0]->contrasena) {
                $data = [
                    "id" => $datosUsuarios[0]->id,
                    "usuario" => $datosUsuarios[0]->usuario,
                    "nombres" => $datosUsuarios[0]->nombres,
                    "apellidos" => $datosUsuarios[0]->apellidos,
                    "cargo" => $datosUsuarios[0]->cargo
                ];
                $session = session();
                $session->set($data);
                return json_encode(array('success' => true, 'mensaje' => 'datos correcto'));
            } else {
                return json_encode(array('success' => false, 'mensaje' => 'contraseña incorrecta'));
            }
        } else {
            return json_encode(array('success' => false, 'mensaje' => 'usuario no encontrado'));
        }
    }
}
