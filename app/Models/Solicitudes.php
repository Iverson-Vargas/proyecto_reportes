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

    public function getSolicitudesConDetalles(): array
    {
        $builder = $this->db->table('solicitudes as s');
        $builder->select('
            s.id AS solicitud_id,
            s.descripcion,
            s.fecha,
            d.nombre AS departamento_nombre,
            CONCAT(u.nombres, " ", u.apellidos) AS nombre_solicitante
        ');
        $builder->join('usuarios as u', 's.solicitante_id = u.id', 'inner');
        $builder->join('departamentos as d', 'u.departamento_id = d.id', 'inner');
        $builder->orderBy('d.nombre', 'ASC');
        $builder->orderBy('s.fecha', 'DESC');

        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getSolicitudesConTipoFalla(): array
    {
        $builder = $this->db->table('solicitudes as s');
        $builder->select('
            s.id AS solicitud_id,
            s.descripcion,
            s.fecha,
            tf.nombre AS tipo_falla_nombre,
            CONCAT(u.nombres, " ", u.apellidos) AS nombre_solicitante
        ');
        $builder->join('tipos_fallas as tf', 's.tipo_falla_id = tf.id', 'inner');
        $builder->join('usuarios as u', 's.solicitante_id = u.id', 'inner');
        $builder->orderBy('tf.nombre', 'ASC');
        $builder->orderBy('s.fecha', 'DESC');

        $query = $builder->get();
        return $query->getResultArray();
    }
}