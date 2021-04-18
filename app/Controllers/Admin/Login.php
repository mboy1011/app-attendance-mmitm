<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Login extends BaseController
{
	public function index()
	{
		return view('login');
	}
    public function product($name)
    {
        echo "<h1>Name</h1>".$name;

        // return view('product');
    }
}
