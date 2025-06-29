<?php

namespace App\Controllers;

use App\Models\EliminarDepartamento;

class EliminarDepartment extends BaseController
{
    public function eliminarDepartment(){

        $json = $this->request->getJSON();
        $id = $json->id ?? null;

        if(empty($id)){
             return $this->response->setJSON(['success' => false, 'message' => 'Los datos no pueden estar vacíos']);
        }

        $EliminarDepartamento = new EliminarDepartamento();
        $resultado = $EliminarDepartamento->eliminarDepartamento($id);
        if($resultado){
               return json_encode(array('success' => true, 'message' => 'Departamento eliminado correctamente'));
        } else {
            return json_encode(array('success' => false, 'message' => 'Error al eliminar el departamento'));
        }
    }


}