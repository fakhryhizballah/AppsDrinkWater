<?php

namespace App\Controllers;

use App\Models\user_m;

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
			'title' => 'Registrasi',
			'validation' => \Config\Services::validation()
		];
		return view('auth/regis', $data);
	}

	public function tambah()
	{
		$data = [
			'title' => 'Registrasi',
			'validation' => \Config\Services::validation()
		];
		if (!$this->validate([
			'nama' => [
				'rules' => 'required|trim',
				'errors' => [
					'required' => '{field} harus diisi.',
				]
			],
			'email' => [
				'rules' => 'required|trim|is_unique[user.email]',
				'errors' => [
					'required' => '{field} harus diisi.',
					'is_unique' => '{field} sudah ada.'
				]
			],
			'telp' => 'required',
			'password1' => 'required',
			'password2' => 'required',
		])) {
			$validation = \config\Services::validation();

			$data['validation'] = $validation;
			// echo view('layout/auth_header');
			// return redirect()->to('auth/regis')->withInput()->with('validation', $validation);
			return view('auth/regis', $data);

			// echo view('layout/auth_footer');
		} else {
			echo "berhasil";
		}
	}

	//--------------------------------------------------------------------

}
