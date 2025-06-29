<?php

namespace App\Models;

use CodeIgniter\Model;

class EliminarUsuario extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'usuario_estado_id'
    ];

    public function eliminacionLogica($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->where('id', $id)->update(['usuario_estado_id' => 2]);
    }
}