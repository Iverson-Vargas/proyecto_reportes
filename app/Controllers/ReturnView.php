<?php

namespace App\Controllers;

class ReturnView extends BaseController
{
    public function inicio()
    {
        return view('inicio');
    }

    public function prueba()
    {
        if (session('usuario')) {
            return view('prueba');
        } else {
            return redirect()->to(base_url('/'));
        }
    }

    public function iniciarSesion()
    {
        if (session('usuario')) {
            return redirect()->to(base_url('/inicio'));
        }

        return view('iniciarSesion');
    }
}
