<?php 
namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model{  
  protected $table = 'usuarios';
  protected $primaryKey = 'id';
  protected $returnType = 'array';
  protected $allowedFields = ['id',
                            'email',
                            'contrasenia',
                            'nombre',
                            'apellido',
                            'genero',
                            'telefono',
                            'fechana_cimiento',
                            'validacion',
                            'pais',
                            'provincia',
                            'ciudad',
                            'calle',
                            'altura',
                            'latitud',
                            'longitud',
                            'token'];


  protected $beforeInsert = ['beforeInsert'];
  protected $beforeUpdate = ['beforeUpdate'];


}