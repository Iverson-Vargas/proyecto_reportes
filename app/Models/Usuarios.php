<?php

namespace App\Models;

use CodeIgniter\Model;

class Usuarios extends Model{

    protected $table = 'usuarios';
    protected $primaryKey = 'id';

    public function traerUsuarios($estado = null)
    {
        $builder = $this->db->table('usuarios');
        $builder->select('usuarios.*, cargos.nombre AS cargo, departamentos.nombre AS departamento, roles.nombre AS rol');
        $builder->join('cargos', 'cargos.id = usuarios.cargo_id', 'left');
        $builder->join('departamentos', 'departamentos.id = usuarios.departamento_id', 'left');
        $builder->join('roles', 'roles.id = usuarios.rol_id', 'left');
        if ($estado !== null) {
            $builder->where('usuarios.usuario_estado_id', $estado);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }

}