<?php

namespace App\Controllers;

class ReturnView extends BaseController
{
    public function inicio()
    {
        return view('inicio');
    }

    public function solicitudes()
    {
        if (session('usuario')) {
            $data['titulo'] = 'Solicitudes | SAID SYSTEMS';
            return view('solicitudes', $data);
        } else {
            return redirect()->to(base_url('/'));
        }
    }

    public function misSolicitudes()
    {
        if (session('usuario')) {
            $data['titulo'] = 'Mis Solicitudes | SAID SYSTEMS';
            return view('misSolicitudes', $data);
        } else {
            return redirect()->to(base_url('/'));
        }
    }

    public function iniciarSesion()
    {
        if (session('usuario')) {
            return redirect()->to(base_url('/inicio'));
        }
        $data['titulo'] = 'Iniciar Sesion | SAID SYSTEMS';
        return view('iniciarSesion', $data);
    }

    public function usuarios()
    {
        if (session('usuario')) {
            $data['titulo'] = 'Usuarios | SAID SYSTEMS';
            return view('usuarios', $data);
        } else {
            return redirect()->to(base_url('/'));
        }
    }

    public function cargos()
    {
        if (session('usuario')) {
            $data['titulo'] = 'Cargos | SAID SYSTEMS';
            return view('cargos', $data);
        } else {
            return redirect()->to(base_url('/'));
        }
    }
    public function departamentos()
    {
        if (session('usuario')) {
            $data['titulo'] = 'Departamentos | SAID SYSTEMS';
            return view('departamentos');
        } else {
            return redirect()->to(base_url('/'));
        }
    }
}
