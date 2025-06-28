<?php

namespace App\Models;

use CodeIgniter\Model;

class Usuarios extends Model
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
        $builder->select('usuarios.*, cargos.nombre AS cargo');
        $builder->join('cargos', 'cargos.id = usuarios.cargo_id', 'left');
        $builder->where('usuarios.usuario', $usuario);
        $query = $builder->get();
        return $query->getResultObject();
    }
}
