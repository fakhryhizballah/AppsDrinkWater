<?php

namespace App\Controllers;

class Auth extends BaseController
{
	public function index()
	{

		return view('auth/login');
	}

	public function regis()
	{
		// echo view('layout/auth_header');
		return view('auth/regis');
		// echo view('layout/auth_footer');
	}

	//--------------------------------------------------------------------

}
