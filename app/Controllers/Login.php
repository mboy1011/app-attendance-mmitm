<?php

namespace App\Controllers;

class Login extends BaseController
{
	public function index()
	{
        $data = [
            'title' => 'Login Page'
        ];
        helper('form');
        echo view('header',$data);
		echo view('login');
        echo view('footer');
	}
    public function product($name)
    {
        echo "<h1>Name</h1>".$name;

        // return view('product');
    }
}
