<?php

namespace App\Controllers;

class Auth extends BaseController
{

	public function index()
	{
		$data = [
			'title' => 'Login'
		];
		return view('auth/login', $data);
	}

	public function regis()
	{

		$data = [
			'title' => 'Registrasi'
		];
		// echo view('layout/auth_header');
		return view('auth/regis', $data);
		// echo view('layout/auth_footer');


	}

	//--------------------------------------------------------------------

}
