<?php

namespace App\Models;

use CodeIgniter\Model;

class CrearCargo extends Model
{
 protected $table = 'cargos';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nombre'
    ];

    public function insertarCargo($data)
    {
        $builder = $this->db->table('cargos');
        return $builder->insert($data);
    }

}