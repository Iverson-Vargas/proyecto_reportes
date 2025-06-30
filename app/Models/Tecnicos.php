<?php

namespace App\Models;
use CodeIgniter\Model;

class Tecnicos extends Model 
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';

    public function buscarTecnicos(){
        $builder = $this->db->table('usuarios');
        $builder->select('usuarios.*, roles.nombre AS rol');
        $builder->join('roles', 'roles.id = usuarios.rol_id', 'left');
        $builder->where('usuarios.rol_id', 2);
        $query = $builder->get();
        return $query->getResultArray();
    }
}