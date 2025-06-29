<?php 

namespace App\Models;

use CodeIgniter\Model;

class EliminarCargo extends Model
{
    protected $table = 'cargos';
    protected $primaryKey = 'id';
 
    public function eliminarCargo($id){
        $builder= $this->db->table('cargos');
        return $builder->where('id', $id)->delete();
    }
}