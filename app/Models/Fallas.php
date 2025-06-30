<?php

namespace App\Models;

use CodeIgniter\Model;

class Fallas extends Model{
     protected $table = 'tipos_fallas';
    protected $primaryKey = 'id';

    public function traeFallas(){

        $builder= $this->db->table('tipos_fallas');
        $builder->select('*');
        $query= $builder->get();
        return $query->getResultArray();

    }

}