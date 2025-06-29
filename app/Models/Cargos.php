<?php

namespace App\Models;

use CodeIgniter\Model;

class Cargos extends Model{

    protected $table = 'cargos';
    protected $primaryKey = 'id';

    public function traerCargos(){

        $builder= $this->db->table('cargos');
        $builder->select('*');
        $query= $builder->get();
        return $query->getResultArray();

    }

}