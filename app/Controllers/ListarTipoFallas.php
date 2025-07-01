<?php

namespace App\Controllers;

use App\Models\TipoFallas;

class ListarTipoFallas extends BaseController
{
    public function returnTiposFallas()
    {
        $tipoFallasModel = new TipoFallas();
        $resultadoDB = $tipoFallasModel->getTiposFallas();

        // Verificamos si la consulta devolvió datos
        if (empty($resultadoDB)) {
            // Enviamos una respuesta vacía pero exitosa si no hay datos
            return $this->response->setJSON(['success' => true, 'labels' => [], 'data' => []]);
        }
        
        // Obtenemos la primera (y única) fila de resultados
        $datosFallas = $resultadoDB[0];

        // Separamos las claves (nombres de las fallas) para usarlas como etiquetas
        $labels = array_keys($datosFallas);
        
        // Separamos los valores (conteos) para usarlos como datos del gráfico
        // Usamos array_map para asegurarnos de que los valores sean numéricos
        $data = array_map('intval', array_values($datosFallas));

        // Creamos el array final con el formato que el frontend espera
        $respuestaFinal = [
            'success' => true,
            'labels'  => $labels,
            'data'    => $data
        ];

        // Usamos el método de respuesta de CodeIgniter para enviar el JSON
        return $this->response->setJSON($respuestaFinal);
    }

    public function fallasPorDepartamento()
    {
        $reportesModel = new TipoFallas();
        $datos = $reportesModel->getFallasPorDepartamento();

        // Si no hay datos, devolvemos arrays vacíos
        if (empty($datos)) {
            return $this->response->setJSON(['success' => true, 'labels' => [], 'data' => []]);
        }

        // Usamos array_column para separar fácilmente los datos para el gráfico
        $labels = array_column($datos, 'departamento');
        $data = array_column($datos, 'total_fallas');
        
        // Creamos la respuesta final con el formato que necesita Chart.js
        $respuestaFinal = [
            'success' => true,
            'labels'  => $labels,
            'data'    => $data
        ];

        return $this->response->setJSON($respuestaFinal);
    }
}