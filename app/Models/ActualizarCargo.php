<?php

namespace App\Models;

use CodeIgniter\Model;

class ActualizarCargo extends Model
{
    protected $table = 'cargos';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nombre'
    ];

    public function actualizarCargo($id, $data)
    {
        $builder = $this->db->table('cargos');
        return $builder->where('id', $id)->update($data);
    }
}