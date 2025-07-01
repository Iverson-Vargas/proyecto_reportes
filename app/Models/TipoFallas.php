<?php

namespace App\Models;

use CodeIgniter\Model;

class TipoFallas extends Model
{
    protected $table = 'solicitudes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['fecha', 'descripcion', 'solicitante_id', 'receptor_id', 'estado_id', 'rol_id', 'tipo_falla_id'];
    
    public function getTiposFallas()
    {
        $builder = $this->db->table('solicitudes');
        $builder->select('COUNT(CASE WHEN tipo_falla_id = 1 THEN 1 END) AS "Fallas de Software",
                          COUNT(CASE WHEN tipo_falla_id = 2 THEN 1 END) AS "Fallas de Hardware",
                          COUNT(CASE WHEN tipo_falla_id = 3 THEN 1 END) AS "Fallas de Periféricos",
                          COUNT(CASE WHEN tipo_falla_id = 4 THEN 1 END) AS "Otros tipos de Fallas"');

        $query = $builder->get();
        // Cambiamos a getResultArray() para obtener un array asociativo, más fácil de manejar.
        return $query->getResultArray(); 
    }

    public function getFallasPorDepartamento()
    {
        // Usamos el Query Builder de CodeIgniter para construir la consulta
        $builder = $this->db->table('solicitudes as s');
        $builder->select('d.nombre AS departamento, COUNT(s.id) AS total_fallas');
        $builder->join('usuarios as u', 's.solicitante_id = u.id', 'inner');
        $builder->join('departamentos as d', 'u.departamento_id = d.id', 'inner');
        $builder->groupBy('d.nombre');
        $builder->orderBy('total_fallas', 'DESC');

        $query = $builder->get();
        return $query->getResultArray(); // Devuelve el resultado como un array
    }
} 
