<?php

namespace App\Controllers;

use App\Models\Usuario;

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

        $Usuario = new Usuario();
        $datosUsuario = $Usuario->getUsuario($usuario);

        if (count($datosUsuario) > 0) {
            if ($contrasena == $datosUsuario[0]->contrasena) {
                $data = [
                    "id" => $datosUsuario[0]->id,
                    "usuario" => $datosUsuario[0]->usuario,
                    "nombres" => $datosUsuario[0]->nombres,
                    "apellidos" => $datosUsuario[0]->apellidos,
                    "cargo" => $datosUsuario[0]->cargo,
                    "rol" => $datosUsuario[0]->rol
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
