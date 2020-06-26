<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{

		$data['title'] = 'PB Login';

		$this->load->view('auth/login');
	}

	//--------------------------------------------------------------------

}
