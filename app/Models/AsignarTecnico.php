<?php

namespace App\Models;

use CodeIgniter\Model;

class AsignarTecnico extends Model
{
    protected $table = 'solicitudes';
    protected $primaryKey = 'id';

    protected $allowedFields = ['fecha', 'descripcion', 'solicitante_id', 'receptor_id', 'estado_id', 'rol_id', 'tipo_falla_id'];

    public function actualizarSolicitud($id, $datos)
    {
        $builder = $this->db->table('solicitudes');
        return $builder->where('id', $id)->update($datos);
    }

}