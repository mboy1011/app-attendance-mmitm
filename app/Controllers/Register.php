<?php

namespace App\Controllers;

class Register extends BaseController
{
	public function index()
	{
        $data = [
            'title' => 'Registration Page'
        ];
     echo view('header',$data);
     echo view('dashboard');
     echo view('footer');
	}
    public function register($name)
    {
        $data = [

        ];
        helper(['form']);
        if ($this->request->getMethod() == 'post') {
            $rules=[
                'firstname' => 'required|min_length[3]|max_length[20]',
                'lastname' => 'required|min_length[3]|max_length[20]',
                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'password' => 'required|min_length[8]|max_length[255]',
                'password_confirm' => 'matches[password]'
            ];
            if (!$this->validate($rules)) {
                $data['validation']=$this->validator;
            }else{
                //store the user
            }
        }
    }
}
