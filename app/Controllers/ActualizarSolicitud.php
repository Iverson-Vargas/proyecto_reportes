<?php 

namespace App\Controllers;

use App\Models\AsignarTecnico;

class ActualizarSolicitud extends BaseController
{
    public function updateSolicitud()
    {
        $json = $this->request->getJSON();
        $id = $json->id ?? null;
        $receptor_id = $json->receptor_id ?? null;

        if(empty($id) || empty($receptor_id)){
            return $this->response->setJSON(['success' => false, 'message' => 'Los datos no pueden estar vacíos']);
        }

        $datos = [
            'receptor_id' => $receptor_id,
            'estado_id' => 2 
        ];

        $AsignarTecnico = new AsignarTecnico();
        $resultado = $AsignarTecnico->actualizarSolicitud($id, $datos);

        if ($resultado) {
            return json_encode(array('success' => true, 'message' => 'Solicitud actualizada correctamente'));
        } else {
            return json_encode(array('success' => false, 'message' => 'Error al actualizar la solicitud'));
        }

    }
}