<?php

namespace App\Models;

use CodeIgniter\Model;

class ActualizarUsuario extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'usuario',
        'contrasena',
        'nombres',
        'apellidos',
        'cargo_id',
        'rol_id',
        'departamento_id',
        'usuario_estado_id'
    ];

    public function actualizarUsuario($id, $data)
    {
        $builder = $this->db->table('usuarios');
        return $builder->where('id', $id)->update($data);
    }
}