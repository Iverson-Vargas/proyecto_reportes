<?php

namespace App\Models;

use CodeIgniter\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';

    public function obtenerUsuario($data)
    {
        return $this->where($data)->findAll();
    }

    public function getUsuario($usuario)
    {
        $builder = $this->db->table('usuarios');
        $builder->select('usuarios.*, cargos.nombre AS cargo, roles.nombre AS rol');
        $builder->join('cargos', 'cargos.id = usuarios.cargo_id', 'left');
        $builder->join('roles', 'roles.id = usuarios.rol_id', 'left');
        $builder->where('usuarios.usuario', $usuario);
        $query = $builder->get();
        return $query->getResultObject();
    }
}
