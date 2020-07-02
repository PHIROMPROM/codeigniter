<?php namespace App\Controllers;

use App\Models\ModelPizza;

class Pizza extends BaseController
{
	public function index()
	{
		$data = [];
		helper(['form']);

        $new = new ModelPizza();
		$data['pizzaData'] = $new->findAll();

		return view('index', $data);
	}

    //--------------------------------------------------------------------
    
    public function createUser(){

		$data = [];
		helper(['form']);

		if($this->request->getMethod() == 'post'){

			$rule = [
				'pizza' => 'required|alpha_space',
				'ingredient' => 'required',
				'prize' => 'required|min_length[1]|max_length[50]|numeric'
			];

			if(!$this->validate($rule)){
				$data['validation'] = $this->validator; 
			}else{

				$new = new ModelPizza();

				$newData = [
					'pizza' =>$this->request->getVar('pizza'),
					'ingredient' =>$this->request->getVar('ingredient'),
					'prize' =>$this->request->getVar('prize'),
				];

				$new->insertPizza($newData);
				$session = session();
				$session->setFlashdata('success', 'Successful Insert Pizza!!!');
				return redirect()->to('/index');

			}

		}

		return view('index', $data);
	}

	//--------------------------------------------------------------------

	public function deleteUser($id){
		
		$new = new ModelPizza();
		$new->delete($id);
		return redirect()->to('/index');
	}

	//--------------------------------------------------------------------
}

