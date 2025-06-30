<?php

namespace App\Models;

use CodeIgniter\Model;

class CrearMiSolicitud extends Model
{
    protected $table = 'solicitudes';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'fecha',
        'descripcion',
        'solicitante_id',
        'estado_id',
        'tipo_falla_id'
    ];

    public function insertarMiSolicitud($data){
        $builder = $this->db->table('solicitudes');
        return $builder->insert($data);
    }

}