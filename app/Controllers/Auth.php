<?php

namespace App\Controllers;

use App\Models\user_m;
use App\Models\userModel;
use App\Models\LoginModel;

class Auth extends BaseController
{
	protected $authModel;
	public function __construct()
	{
		$this->authModel = new user_m();
		$this->userModel = new userModel();
		$this->LoginModel = new LoginModel();
	}
	public function index()
	{
		$data = [
			'title' => 'Login'
		];
		return view('auth/login', $data);
	}
	public function login()
	{
		// dd($this->request->getVar());
		$nama = $this->request->getVar('nama');
		$password = !password_verify($this->request->getVar('password'), PASSWORD_DEFAULT);


		$cek = $this->LoginModel->cek_login($nama, $password);
		// dd($cek['nama'], $cek['password']);
		if (empty($cek)) {
			session()->setFlashdata('gagal', 'Akun tidak terdaftar');
			return redirect()->to('/Auth');
		}

		if (($cek['nama'] == $nama) && ($cek['password'] == $password)) {
			session()->set('nama', $cek['nama']);
			return redirect()->to('/page');
		} else {
			session()->setFlashdata('gagal', 'Password salah');
			return redirect()->to('/');
		}
	}

	public function logout()
	{
		session()->destroy();
		session()->setFlashdata('gagal', 'Berhasil Logout');
		return redirect()->to('/');
	}

	public function regis()
	{
		//session();
		$data = [
			'title' => 'Registrasi',
			'validation' => \Config\Services::validation()
		];
		return view('auth/regis', $data);
	}

	public function save()
	{
		//validasi
		if (!$this->validate([
			'aID' => [
				'rules'  => 'required|is_unique[user.aID]',
				'errors' => [
					'required' => 'ID Account wajid di isi',
					'is_unique' => 'Account sudah terdaftar'
				]
			],
			'nama' => [
				'rules'  => 'required',
				'errors' => [
					'required' => '{field} wajid di isi'
				]
			],
			'cv' => [
				'rules'  => 'required',
				'errors' => [
					'required' => '{field} wajid di isi'
				]
			],
			'email' => [
				'rules'  => 'required|valid_email|is_unique[user.email]',
				'errors' => [
					'required' => '{field} wajid di isi',
					'valid_email' => 'alamat email tidak benar',
					'is_unique' => '{field} sudah terdaftar'
				]
			],
			'telp' => [
				'rules'  => 'required|is_natural|is_unique[user.telp]',
				'errors' => [
					'required' => 'nomor telpon wajid di isi',
					'is_natural' => 'nomor telpon tidak benar',
					//'min_length' => 'nomor telpon tidak valid',
					'is_unique' => 'nomor telp sudah terdaftar'
				]
			],
			'password' => [
				'rules'  => 'required|min_length[8]',
				'errors' => [
					'required' => '{field} wajid di isi',
					'min_length[8]' => '{field} Minimal 8 karakter'
				]
			],
			'password2' => [
				'rules'  => 'required|matches[password]',
				'errors' => [
					'required' => 'password wajid di isi',
					'matches' => 'password tidak sama'
				]
			]

		])) {
			$validation = \config\Services::validation();

			return redirect()->to('/regis')->withInput()->with('validation', $validation);
		}
		$data = [
			'title' => 'Registrasi',
			'validation' => \Config\Services::validation()
		];
		// dd($this->request->getVar());
		$this->userModel->save([
			'aID' => $this->request->getVar('aID'),
			'nama' => $this->request->getVar('nama'),
			'cv' => $this->request->getVar('cv'),
			'email' => $this->request->getVar('email'),
			'telp' => $this->request->getVar('telp'),
			'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)


		]);
		session()->setFlashdata('Pesan', 'Registration success.');
		return redirect()->to('/Auth');
	}

	//--------------------------------------------------------------------

}
