<?php 

namespace App\Controllers;

use App\Models\Solicitudes;

class FinalizarSolicitud extends BaseController
{
    public function completarSolicitud(){

        $json = $this->request->getJSON();
        $id = $json->id ?? null;

        if(empty($id)){
             return $this->response->setJSON(['success' => false, 'message' => 'Los datos no pueden estar vacíos']);
        }

        $datos = ['estado_id' => 3];

        $FinalizarSolicitud = new Solicitudes();
        $resultado = $FinalizarSolicitud->finalizarSolicitud($id, $datos);

        if ($resultado) {
            return json_encode(array('success' => true, 'message' => 'Solicitud finalizada correctamente'));
        } else {
            return json_encode(array('success' => false, 'message' => 'Error al finalizar la solicitud'));
        }
    }
}