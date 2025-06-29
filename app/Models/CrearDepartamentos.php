<?php

namespace App\Models;

use CodeIgniter\Model;

class CrearDepartamentos extends Model
{
 protected $table = 'departamentos';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nombre'
    ];

    public function insertarDepartamento($data)
    {
        $builder = $this->db->table('departamentos');
        return $builder->insert($data);
    }

}