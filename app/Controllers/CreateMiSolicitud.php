<?php

namespace App\Controllers;

use App\Models\CrearMiSolicitud;

class CreateMiSolicitud extends BaseController
{
    public function validarMiSolicitud()
    {
        $json = $this->request->getJSON();
        $fecha = $json->fecha ?? null;
        $descripcion = $json->descripcion ?? null;
        $solicitante_id = $json->solicitante_id ?? null;
        $tipoFalla_id = $json->tipoFalla_id ?? null;

        if(empty($fecha) || empty($descripcion) || empty($solicitante_id) || empty($tipoFalla_id)){
              return $this->response->setJSON(['success' => false, 'message' => 'Los datos no pueden estar vacíos']);
        }

        $datos = [

            'fecha' => $fecha,
            'descripcion' => $descripcion,
            'solicitante_id' => $solicitante_id,
            'estado_id' => 1,
            'tipo_falla_id' => $tipoFalla_id

        ];

        $CrearMiSolicitud = new CrearMiSolicitud();
        $resultado = $CrearMiSolicitud->insertarMiSolicitud($datos);
        if ($resultado) {
            return json_encode(array('success' => true, 'message' => 'Mi solicitud fue creada correctamente'));
        } else {
            return json_encode(array('success' => false, 'message' => 'Error al crear mi solicitud'));
        }
    }

}