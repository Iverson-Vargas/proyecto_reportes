<?php

namespace App\Controllers;

use App\Models\Departamentos;

class ListarDepartamentos extends BaseController
{
    public function returnDepartamentos(){
        $Departamentos = new Departamentos();
        $datosDepartamentos = $Departamentos->traerDepartamentos();
        return $this->response->setJSON(['success' => true, 'data' => $datosDepartamentos]);
    }
}