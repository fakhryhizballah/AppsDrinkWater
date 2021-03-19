<?php

namespace App\Controllers;


use App\Models\DriverModel;
use App\Models\LoginModel;
use App\Models\UserModel;
use App\Models\OtpModel;
// use CodeIgniter\I18n\Time;


class Auth extends BaseController
{
	protected $authModel;
	public function __construct()
	{
		$this->DriverModel = new DriverModel();
		$this->LoginModel = new LoginModel();
		$this->UserModel = new UserModel();
		$this->OtpModel = new OtpModel();
		// $this->Time = new Time('Asia/Jakarta');
		$this->email = \Config\Services::email();
	}

	public function index()
	{
		if (session()->get('id_user') == '') {
			$data = [
				'title' => 'Login - Spairum',
				'validation' => \Config\Services::validation()
			];
			return view('Auth/Login', $data);
		} else {
			return redirect()->to('/user');
		}
	}

	//--------------------------------------------------------------------

	public function login()
	{
		// dd($this->request->getVar());
		$nama = $this->request->getVar('nama');
		// $password = password_verify($this->request->getVar('password'), PASSWORD_BCRYPT);
		$pas = ($this->request->getVar('password'));
		// $level = $this->request->getVar('level');
		//validasi	
		if (!$this->validate([
			'nama' => [
				'rules'  => 'required',
				'errors' => [
					'required' => '{field} wajid di isi'
				]
			],
		])) {
			$validation = \config\Services::validation();
			return redirect()->to('/')->withInput()->with('validation', $validation);
		}
		$data = [
			'title' => 'Registrasi',
			'validation' => \Config\Services::validation()
		];
		$cek = $this->UserModel->cek_login($nama);
		// dd($cek);
		if (empty($cek)) {
			session()->setFlashdata('gagal', 'Akun tidak terdaftar');
			return redirect()->to('/');
		}
		$password = password_verify($pas, ($cek['password']));
		//dd($password);

		if (($cek['password'] == $password)) {
			//dd($cek);
			session()->set('nama', $cek['nama']);
			session()->set('id_user', $cek['id_user']);
			return redirect()->to('/user');
		} else {
			session()->setFlashdata('gagal', 'Username atau Password salah');
			return redirect()->to('/');
		}
	}

	//--------------------------------------------------------------------

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

		$data = [
			'title' => 'Registrasi',
			'validation' => \Config\Services::validation()
		];
		return view('auth/regis', $data);
	}
	public function daftar()
	{
		if (session()->get('id_user') == '') {
			$data = [
				'title' => 'Registrasi',
				'validation' => \Config\Services::validation()
			];
			return view('auth/daftar', $data);
		} else {
			return redirect()->to('/user');
		}
	}

	//--------------------------------------------------------------------

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

	//--------------------------------------------------------------------

	public function userSave()
	{
		//validasi
		if (!$this->validate([
			'nama' => [
				'rules'  => 'required|alpha_dash|is_unique[user.nama]',
				'errors' => [
					'required' => '{field} wajid di isi',
					'alpha_dash' => 'Tidak boleh mengunakan spasi',
					'is_unique' => 'Nama Account sudah terdaftar'
				]
			],
			'nama_depan' => [
				'rules'  => 'required',
				'errors' => [
					'required' => '{field} wajid di isi',
				]
			],
			'nama_belakang' => [
				'rules'  => 'required',
				'errors' => [
					'required' => '{field} wajid di isi',
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
		helper('text');
		$token = random_string('alnum', 28);
		$email = $this->request->getVar('email');
		$user = $this->request->getVar('nama');
		$nama_depan =  ucwords($this->request->getVar('nama_depan'));
		$nama_belakang = ucwords($this->request->getVar('nama_belakang'));
		$this->OtpModel->save([
			'id_user' => strtoupper($id_usr),
			'nama' => $user,
			'nama_depan' => $nama_depan,
			'nama_belakang' => $nama_belakang,
			'email' => $email,
			'telp' => $this->request->getVar('telp'),
			'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
			'link' => $token,
			'status' => 'belum verivikasi'


		]);
		$this->email->setFrom('infospairum@gmail.com', 'noreply-spairum');
		$this->email->setTo($email);
		// $this->email->setBCC('falehry88@gmail.com');
		$this->email->setSubject('Verification Akun Anda');
		$this->email->setMessage("
		<table align='center' cellpadding='0' cellspacing='0' border='0' width='100%' bgcolor='#f0f0f0'>
		<tr>
			<td style='padding: 30px 30px 20px 30px;'>
				<table cellpadding='0' cellspacing='0' border='0' width='100%' bgcolor='#ffffff' style='max-width: 650px; margin: auto;'>
					<tr>
						<td colspan='2' align='center' style='background-color: #0d8eff; padding: 40px;'>
							<a href='https://spairum.my.id/' target='_blank'><img src='https://spairum.my.id/Asset/img/spairum.png' width='50%' border='0' /></a>
						</td>
					</tr>
					<tr>
						<td colspan='2' align='center' style='padding: 50px 50px 0px 50px;'>
							<h1 style='padding-right: 0em; margin: 0; line-height: 40px; font-weight:300; font-family: ' Nunito Sans ', Arial, Verdana, Helvetica, sans-serif; color: #666; text-align: left; padding-bottom: 1em;'>
								Stasiun Pengisian Air Minum (SPAIRUM)
								<Br>Verivikasi Email</Br>
							</h1>
						</td>
					</tr>
					<tr>
						<td style='text-align: left; padding: 0px 50px;' valign='top'>
							<p style='font-size: 18px; margin: 0; line-height: 24px; font-family: ' Nunito Sans ', Arial, Verdana, Helvetica, sans-serif; color: #666; text-align: left; padding-bottom: 3%;'>
								Hi $nama_depan $nama_belakang,
							</p>
							<p style='font-size: 18px; margin: 0; line-height: 24px; font-family: ' Nunito Sans ', Arial, Verdana, Helvetica, sans-serif; color: #666; text-align: left; padding-bottom: 3%;'>
								Terimakasih telah membuat akun spairum silahkan melakukan verifikasi akun dengan klik tombol dibawah ini:
							</p>
							<br>
							<a href='https://app.spairum.my.id/otp/$token' style='display:block;width:115px;height:25px;background:#0008ff;padding:10px;text-align:center;border-radius:5px;color:white;font-weight:bold'>Verivikasi di sini</a>
							<p style='font-size: 18px; margin: 0; line-height: 24px; font-family: ' Nunito Sans ', Arial, Verdana, Helvetica, sans-serif; color: #666; text-align: left; padding-bottom: 3%;'><br/>Selanjutnya anda dapat melakukan login ke app.spairum.my.id sebagai user</p>
						</td>
					</tr>
					<tr>
						<td style='text-align: left; padding: 30px 50px 50px 50px' valign='top'>
							<p style='font-size: 18px; margin: 0; line-height: 24px; font-family: ' Nunito Sans ', Arial, Verdana, Helvetica, sans-serif; color: #505050; text-align: left;'>
								Thanks and best regards<br/>
							</p>
							<br> Spairum Team
						</td>
					</tr>
					<tr>
						<td colspan='2' align='center' style='padding: 20px 40px 40px 40px;' bgcolor='#f0f0f0'>
							<p style='font-size: 12px; margin: 0; line-height: 24px; font-family: ' Nunito Sans ', Arial, Verdana, Helvetica, sans-serif; color: #777;'>
								&copy; 2021
								<a href='https://spairum.my.id/about' target='_blank' style='color: #777; text-decoration: none'>Spairum.my.id</a>
								<br> Jl.Merdeka, Pontianak - Kalimantan Barat
								<br> Indonesia
							</p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>");
		$this->email->send();
		session()->setFlashdata('flash', 'Silakan cek kotak masuk email atau spam untuk verifikasi.');
		return redirect()->to('/');
	}

	public function otp($link)
	{
		$cek = $this->OtpModel->cek($link);
		if (empty($cek)) {
			session()->setFlashdata('gagal', 'Akun sudah di verifikasi');
			return redirect()->to('/');
		}
		$this->UserModel->save([
			'id_user' => $cek['id_user'],
			'nama' => $cek['nama'],
			'nama_depan' => $cek['nama_depan'],
			'nama_belakang' => $cek['nama_belakang'],
			'email' => $cek['email'],
			'telp' => $cek['telp'],
			'password' => $cek['password'],
			'profil' => 'user.png',
			'debit' => '0',
			'kredit' => '0',
		]);
		$this->OtpModel->save([
			'id' => $cek['id'],
			'link' => substr(sha1($cek['link']), 0, 10),
			'status' => 'tercerivikasi',
		]);
		session()->setFlashdata('flash', 'Registration success silahkan login.');
		return redirect()->to('/');
	}
}
