<?php

namespace App\Controllers;

use Config\Email;
use CodeIgniter\Controller;
use Myth\Auth\Entities\User;

class Auth extends BaseController
{
	protected $authModel;
	public function __construct()
	{
		$this->authModel = new user_m();
	}
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

	public function save()
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
			'telp' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus diisi.',
				]
			],
			'password' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus diisi.',
				]
			],
			'password2' => 'required',
		])) {
			$validation = \config\Services::validation();

			$data['validation'] = $validation;
			// echo view('layout/auth_header');
			// return redirect()->to('/regis')->withInput()->with('validation', $validation);
			return view('auth/regis', $data);

			// echo view('layout/auth_footer');
		} else {
			// $this->authModel->save([
			// 	'nama' => $this->request->getVar('nama'),
			// 	'email' => $this->request->getVar('email'),
			// 	'telp' => $this->request->getVar('telp'),
			// 	'image' => 'default.jpg',
			// 	'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
			// 	'role_id' => '2',
			// 	'is_active' => 1
			// ]);
			$data = [
				'nama' => $this->request->getVar('nama'),
				'email' => $this->request->getVar('email'),
				'telp' => $this->request->getVar('telp'),
				'image' => 'default.jpg',
				'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
				'role_id' => '2',
				'is_active' => 1
			];

			$this->authModel->insert($data);
			return redirect()->to('/auth');
		}
	}

	//--------------------------------------------------------------------

}
