<?php

namespace App\Models;

use CodeIgniter\Model;

class Departamentos extends Model{
    protected $table = 'departamentos';
    protected $primaryKey = 'id';

     public function traerDepartamentos(){

        $builder= $this->db->table('departamentos');
        $builder->select('*');
        $query= $builder->get();
        return $query->getResultArray();

    }

}