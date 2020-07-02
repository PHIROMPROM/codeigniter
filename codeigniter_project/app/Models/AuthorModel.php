<?php namespace App\Models;

use CodeIgniter\Model;

class AuthorModel extends Model
{
    protected $table      = 'register_data';
    protected $primaryKey = 'id';
    protected $returnType     = 'array';
    protected $allowedFields = ['email', 'password', 'address', 'role'];


    public function insertUser($info){
        
        $this->insert([

            'email' => $info['email'],
            'password' => password_hash($info['password'], PASSWORD_DEFAULT),
            'address' => $info['address'],
            'role' => $info['role'],

        ]);
    }

}











