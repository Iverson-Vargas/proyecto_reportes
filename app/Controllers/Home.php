<?php

namespace App\Controllers;
use App\Models\Usuarios;

class Home extends BaseController
{
    public function inicio()
    {
        return view('inicio');
    }

    public function welcome()
    {
        return view('welcome_message');
    }

    public function iniciarSesion()
    {
        if (session('usuario')) {
        // Si ya hay sesión, redirige a la página de inicio
        return redirect()->to(base_url('/inicio'));
    }
        $mensaje = session('mensaje');
        return view('iniciarSesion', ["mensaje" => $mensaje]);
    }

    public function login()
    {
        $usuario = $this->request->getPost('usuario');
        $contrasena = $this->request->getPost('contrasena');

        // Validación básica de campos vacíos
        if (empty($usuario) || empty($contrasena)) {
            return redirect()->to(base_url('/'))->with('mensaje', 'Debes ingresar usuario y contraseña');
        }

        $Usuario = new Usuarios();
        $datosUsuarios = $Usuario->obtenerUsuario(['usuario' => $usuario]);

        if (count($datosUsuarios) > 0) {

            if($contrasena == $datosUsuarios[0]['contrasena']){
                $data = [
                    "id" => $datosUsuarios[0]['id'],
                    "usuario" => $datosUsuarios[0]['usuario'],
                    "nombres" => $datosUsuarios[0]['nombres'],
                    "apellidos" => $datosUsuarios[0]['apellidos']
                ];
                $session = session();
                $session->set($data);
                return redirect()->to(base_url('/inicio'))->with('mensaje', '1');
            }else{
                return redirect()->to(base_url('/'))->with('mensaje', 'Contraseña incorrecta');
            }
        } else {
            return redirect()->to(base_url('/'))->with('mensaje', 'Usuario no encontrado');
        }
    }

    public function salir()
    {
        $session = session();
		$session->destroy();
		return redirect()->to(base_url('/'));
    }
}
