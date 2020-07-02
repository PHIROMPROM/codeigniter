<?php namespace App\Controllers;

use App\Models\AuthorModel;

class Author extends BaseController
{
	public function loginUser()
	{
		$data = [];
		helper(['form']);

        if($this->request->getMethod() == 'post'){

			$rules = [
				'email' => 'trim|required|valid_email',
				'password' => 'required|validateUser[email,password]',
			];

			$errors = [
				'password' => [
					'validateUser' => 'Email or Password don\'t match'
				]
			];

			if(!$this->validate($rules, $errors)){
				$data['validation'] = $this->validator; 
			}else{
				$modelUser = new AuthorModel();

				$user = $modelUser->where('email', $this->request->getVar('email'))->first();
				$this->userSession($user);
				return redirect()->to('index');
			}
		}

		return view('login', $data);
	}
    //--------------------------------------------------------------------
    
    private function userSession($user){

		$data = [

			'id' => $user['id'],
			'email' => $user['email'],
			'password' => $user['password'],
			'address' => $user['address'],
			'role' => $user['role'],
			
		];

		session()->set($data);
		return true;
	}



    //--------------------------------------------------------------------

	public function registerUser()
	{
		$data = [];
        helper(['form']);
        

        if($this->request->getMethod() == 'post'){

			$rules = [
				'email' => 'trim|required|valid_email',
				'password' => 'required|trim',
				'address' => 'required'
            ];
            
            if(!$this->validate($rules)){
				$data['validation'] = $this->validator; 
			}else{
				$modelUser = new AuthorModel();

				$newUser = [
					'email' =>$this->request->getVar('email'),
					'password' =>$this->request->getVar('password'),
					'address' =>$this->request->getVar('address'),
					'role' =>$this->request->getVar('role'),
				];

				$modelUser->insertUser($newUser);
				$session = session();
				$session->setFlashdata('success', 'Successful Registration!!!');
				return redirect()->to('/');
			}

        }

		return view('register', $data);
    }


    //--------------------------------------------------------------------

    public function logoutUser(){
		$session()->destroy();
		return redirect()->to('/');
	}
}