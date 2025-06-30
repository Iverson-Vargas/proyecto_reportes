<?php

namespace App\Models;

use CodeIgniter\Model;

class Solicitudes extends Model
{
    protected $table = 'solicitudes';
    protected $primaryKey = 'id';

    protected $allowedFields = ['fecha', 'descripcion', 'solicitante_id', 'receptor_id', 'estado_id', 'rol_id', 'tipo_falla_id'];

    public function traerSolicitudes()
    {
        $builder = $this->db->table('solicitudes');
        $builder->select("solicitudes.*, 
            CONCAT(u.nombres, ' ', u.apellidos) AS solicitante, 
            CONCAT(r.nombres, ' ', r.apellidos) AS receptor, 
            e.nombre AS estado, 
            t.nombre AS tipo_falla");
        $builder->join('usuarios u', 'u.id = solicitudes.solicitante_id', 'left');
        $builder->join('usuarios r', 'r.id = solicitudes.receptor_id', 'left');
        $builder->join('estados_solicitud e', 'e.id = solicitudes.estado_id', 'left');
        $builder->join('tipos_fallas t', 't.id = solicitudes.tipo_falla_id', 'left');
        return $builder->get()->getResultArray();
    }

    public function finalizarSolicitud($id, $datos)
    {
        $builder = $this->db->table('solicitudes');
        return $builder->where('id', $id)->update($datos);
    }
}