<?php namespace App\Models;
use CodeIgniter\Model;

class Usuarios extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';

    public function obtenerUsuario($data)
    {
        return $this->where($data)->findAll();
    }
}