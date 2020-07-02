<?php namespace App\Models;

use CodeIgniter\Model;

class ModelPizza extends Model
{
    protected $table      = 'pizza_data';
    protected $primaryKey = 'id';
    protected $returnType     = 'array';
    protected $allowedFields = ['pizza', 'ingredient', 'prize'];

    public function insertPizza($pizzas){
        
        $this->insert([
            'pizza' => $pizzas['pizza'],
            'ingredient' => $pizzas['ingredient'],
            'prize' => $pizzas['prize'],
        ]);
    }
    
}





