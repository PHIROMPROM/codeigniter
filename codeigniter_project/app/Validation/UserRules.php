<?php 
namespace App\Validation;

use App\Models\AuthorModel;

class UserRules{

    public function validateUser(string $str, string $fields, array $data){

        $modelUser = new AuthorModel();
        $user = $modelUser->where('email', $data['email'])->first();

        if(!$user){
            
            return false;
            return password_verify($data['password'], $user['password']);
        }
    }
}







