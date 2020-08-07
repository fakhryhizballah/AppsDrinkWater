<?php

namespace App\Controllers;


use App\Models\DriverModel;
use App\Models\LoginModel;
use App\Models\UserModel;
// use CodeIgniter\I18n\Time;


class Auth extends BaseController
{
	protected $authModel;
	public function __construct()
	{
		$this->DriverModel = new DriverModel();
		$this->LoginModel = new LoginModel();
		$this->UserModel = new UserModel();
		// $this->Time = new Time('Asia/Jakarta');
	}
	public function index()
	{
		$data = [
			'title' => 'Login',
			'validation' => \Config\Services::validation()
		];
		// $myTime = Time::now('Asia/Pontianak');
		// dd($myTime);

		return view('auth/login', $data);
	}
	public function login()
	{
		// dd($this->request->getVar());
		$nama = $this->request->getVar('nama');
		// $password = password_verify($this->request->getVar('password'), PASSWORD_BCRYPT);
		$pas = ($this->request->getVar('password'));
		$level = $this->request->getVar('level');

		//validasi
		if (!$this->validate([


			'nama' => [
				'rules'  => 'required',
				'errors' => [
					'required' => '{field} wajid di isi'
				]
			],
			'level' => [
				'rules'  => 'numeric',
				'errors' => [
					'numeric' => 'Pilih tipe login sebagai ...',
				]
			]

		])) {
			$validation = \config\Services::validation();

			return redirect()->to('/')->withInput()->with('validation', $validation);
		}
		$data = [
			'title' => 'Registrasi',
			'validation' => \Config\Services::validation()
		];
		//if 
		if ($level == '1') {
			$cek = $this->UserModel->cek_login($nama);
			// dd($cek);
			if (empty($cek)) {
				session()->setFlashdata('gagal', 'Akun tidak terdaftar');
				return redirect()->to('/');
			}
			$password = password_verify($pas, ($cek['password']));
			//dd($password);

			if (($cek['nama'] == $nama) && ($cek['password'] == $password)) {
				//dd($cek);
				session()->set('nama', $cek['nama']);
				session()->set('id_user', $cek['id_user']);
				return redirect()->to('/user');
			} else {
				session()->setFlashdata('gagal', 'Username atau Password salah');
				return redirect()->to('/');
			}
		} elseif ($level == '2') {
			$cek = $this->LoginModel->cek_login($nama);
			// dd($cek('nama')); 
			if (empty($cek)) {
				session()->setFlashdata('gagal', 'Akun tidak terdaftar');
				return redirect()->to('/');
			}
			$password = password_verify($pas, ($cek['password']));
			//dd($password);


			if (($cek['nama'] == $nama) && ($cek['password'] == $password)) {
				//dd($cek);
				session()->set('nama', $cek['nama']);
				session()->set('id_driver', $cek['id_driver']);
				return redirect()->to('/driver');
			} else {
				session()->setFlashdata('gagal', 'Username atau Password salah');
				return redirect()->to('/');
			}
		}
		dd($level);
	}



	public function logout()
	{
		// $array_items = ['nama', 'id_driver', 'id_user'];
		// $session->remove($array_items);
		session()->setFlashdata('flash', 'Berhasil Logout');
		session_destroy();
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
	public function daftar()
	{

		$data = [
			'title' => 'Registrasi',
			'validation' => \Config\Services::validation()
		];
		return view('auth/daftar', $data);
	}

	public function save()
	{
		//validasi
		if (!$this->validate([

			'id_driver' => [
				'rules'  => 'required|is_unique[driver.id_driver]|is_unique[user.id_user]',
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
				'rules'  => 'required|valid_email|is_unique[driver.email]',
				'errors' => [
					'required' => '{field} wajid di isi',
					'valid_email' => 'alamat email tidak benar',
					'is_unique' => '{field} sudah terdaftar'
				]
			],
			'telp' => [
				'rules'  => 'required|is_natural|min_length[10]|is_unique[driver.telp]',
				'errors' => [
					'required' => 'nomor telpon wajid di isi',
					'is_natural' => 'nomor telpon tidak benar',
					'min_length' => 'nomor telpon tidak valid',
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
		//dd($this->request->getVar());
		$this->DriverModel->save([
			'id_driver' => $this->request->getVar('id_driver'),
			'nama' => $this->request->getVar('nama'),
			'cv' => $this->request->getVar('cv'),
			'email' => $this->request->getVar('email'),
			'telp' => $this->request->getVar('telp'),
			'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
			'profil' => 'user.png',
			'Trip' => '0',
			'liter' => '0',
			'poin' => '0'


		]);
		session()->setFlashdata('flash', 'Registration success.');
		return redirect()->to('/');
	}
	public function userSave()
	{
		//validasi
		if (!$this->validate([

			// 'id_user' => [
			// 	'rules'  => 'required|is_unique[user.id_user]',
			// 	'errors' => [
			// 		'required' => 'ID Account wajid di isi',
			// 		'is_unique' => 'ID Account sudah terdaftar'
			// 	]
			// ],
			'nama' => [
				'rules'  => 'required|alpha_dash|is_unique[user.nama]',
				'errors' => [
					'required' => '{field} wajid di isi',
					'alpha_dash' => 'Tidak boleh mengunakan spasi',
					'is_unique' => 'Nama Account sudah terdaftar'
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
				'rules'  => 'required|is_natural|min_length[10]|is_unique[user.telp]',
				'errors' => [
					'required' => 'nomor telpon wajid di isi',
					'is_natural' => 'nomor telpon tidak benar',
					'min_length' => 'nomor telpon tidak valid',
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

			return redirect()->to('/daftar')->withInput()->with('validation', $validation);
		}
		$data = [
			'title' => 'Registrasi',
			'validation' => \Config\Services::validation()
		];
		//dd($this->request->getVar());
		$id = $this->request->getVar('nama');
		$id_usr = substr(sha1($id), 0, 8);
		$this->UserModel->save([
			'id_user' => strtoupper($id_usr),
			'nama' => $this->request->getVar('nama'),
			'email' => $this->request->getVar('email'),
			'telp' => $this->request->getVar('telp'),
			'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
			'profil' => 'user.png',
			'debit' => '0',
			'kredit' => '0',

		]);
		session()->setFlashdata('flash', 'Registration success.');
		return redirect()->to('/');
	}

	//--------------------------------------------------------------------

}
