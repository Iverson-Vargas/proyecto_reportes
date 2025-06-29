<?php 

namespace App\Models;

use CodeIgniter\Model;

class EliminarDepartamento extends Model
{
    protected $table = 'departamentos';
    protected $primaryKey = 'id';
 
    public function eliminarDepartamento($id){
        $builder= $this->db->table('departamentos');
        return $builder->where('id', $id)->delete();
    }
}