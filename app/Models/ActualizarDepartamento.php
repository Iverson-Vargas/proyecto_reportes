<?php

namespace App\Models;

use CodeIgniter\Model;

class ActualizarDepartamento extends Model
{
    protected $table = 'departamentos';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nombre'
    ];

    public function actualizarDepartamento($id, $data)
    {
        $builder = $this->db->table('departamentos');
        return $builder->where('id', $id)->update($data);
    }
}