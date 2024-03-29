<?php

namespace App\Controllers;


use App\Models\DriverModel;
use App\Models\LoginModel;
use App\Models\UserModel;
use App\Models\OtpModel;
use App\Models\TokenModel;
// use CodeIgniter\I18n\Time;
use \Firebase\JWT\JWT;


class Auth extends BaseController
{
	protected $authModel;
	public function __construct()
	{
		$this->DriverModel = new DriverModel();
		$this->LoginModel = new LoginModel();
		$this->UserModel = new UserModel();
		$this->OtpModel = new OtpModel();
		$this->TokenModel = new TokenModel();
		// $this->Time = new Time('Asia/Jakarta');
		$this->email = \Config\Services::email();
		helper('text');
		helper('cookie');
	}

	public static string $key = 'ss';
	public function index()
	{
		if (empty($_COOKIE['X-Sparum-Token'])) {
			$data = [
				'title' => 'Login - Spairum',
				'validation' => \Config\Services::validation()
			];
			return view('auth/login', $data);
		} else {
			if ($_COOKIE['X-Sparum-Token'] == 'Logout') {
				$data = [
					'title' => 'Login - Spairum',
					'validation' => \Config\Services::validation()
				];
				return view('auth/login', $data);
			}
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
			// session()->set('nama', $cek['nama']);
			// session()->set('id_user', $cek['id_user']);

			$token = random_string('alnum', 28);
			$key = $this->TokenModel->Key()['token'];
			$payload = array(
				'Key' => $token,
				'id_user' => $cek['id_user'],
				'nama' => $cek['nama']
			);
			$jwt = JWT::encode($payload, $key,);

			$this->TokenModel->save([
				'id_user' => $cek['id_user'],
				'token'    => $token,
				'status' => 'Login'
			]);
			// setcookie("X-Sparum-Token", $jwt);
			setCookie("X-Sparum-Token", $jwt, time() + (86400 * 30), "/");

			if (empty($_COOKIE['theme-color'])) {
				setCookie("theme-color", "lightblue-theme",  time() + (86400 * 60), "/");
			}

			return redirect()->to('/user');
		} else {
			session()->setFlashdata('gagal', 'Username atau Password salah');
			return redirect()->to('/');
		}
	}

	//--------------------------------------------------------------------

	public function logout()
	{
		$jwt = $_COOKIE['X-Sparum-Token'];
		$key = $this->TokenModel->Key()['token'];
		$decoded = JWT::decode($jwt, $key, array('HS256'));
		$token = $decoded->Key;
		$id = $this->TokenModel->cek($token)['id'];
		$this->TokenModel->update($id, [
			'token'    => "Keluar",
			'status' => 'logout'
		]);
		session()->setFlashdata('flash', 'Berhasil Logout');
		setCookie("X-Sparum-Token", "Logout", time() + (86400 * 30), "/");
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
		$gen = random_string('alnum', 3);
		$id_usr = substr(sha1($id), 0, 8);
		helper('text');
		$token = random_string('alnum', 28);
		$email = $this->request->getVar('email');
		$user = $this->request->getVar('nama');
		$nama_depan =  ucwords($this->request->getVar('nama_depan'));
		$nama_belakang = ucwords($this->request->getVar('nama_belakang'));
		$this->OtpModel->save([
			'id_user' => "$id_usr$gen",
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
			'status' => 'Tercerivikasi',
		]);
		session()->setFlashdata('flash', 'Registration success silahkan login.');
		return redirect()->to('/');
	}
	public function lupa()
	{
		if (session()->get('id_user') == '') {
			$data = [
				'title' => 'Lupa Password',
				'validation' => \Config\Services::validation()
			];
			return view('auth/lupa', $data);
		} else {
			return redirect()->to('/user');
		}
	}
	public function sendemail()
	{
		if (!$this->validate([
			'email' => [
				'rules'  => 'required|valid_email',
				'errors' => [
					'required' => '{field} wajid di isi',
					'valid_email' => 'alamat email tidak benar',
				]
			]

		])) {
			$validation = \config\Services::validation();
			// dd($this->request->getVar());
			return redirect()->to('/lupa')->withInput()->with('validation', $validation);
		}
		helper('text');
		$token = random_string('alnum', 28);
		$kode = substr(random_string('numerik', 4), 0, 4);
		$email = $this->request->getVar('email');
		$cek = $this->UserModel->cek_login($email);
		$id_user = $cek['id_user'];
		$cekid = $this->OtpModel->cekid($id_user);
		if (empty($cek)) {
			session()->setFlashdata('Pesan', 'Akun tidak terdaftar');
			return redirect()->to('/daftar');
		}
		$this->OtpModel->save([
			'id' => $cekid['id'],
			'link' =>  $token,
			'status' => 'Lupa Password',
		]);
		$nama_depan = $cek['nama_depan'];
		$nama_belakang = $cek['nama_belakang'];
		session()->set('token', $kode);
		session()->set('id', $id_user);

		$this->email->setFrom('infospairum@gmail.com', 'noreply-spairum');
		$this->email->setTo($email);
		$this->email->setSubject('OTP Verification Akun');
		$this->email->setMessage(
			"
			<table align='center' cellpadding='0' cellspacing='0' border='0' width='100%' bgcolor='#f0f0f0'>
		    <tr>
		    <td style='padding: 30px 30px 20px 30px;'>
		        <table cellpadding='0' cellspacing='0' border='0' width='100%' bgcolor='#ffffff' style='max-width: 650px; margin: auto;'>
		        <tr>
		            <td colspan='2' align='center' style='background-color: #0d8eff; padding: 40px;'>
		                <a href='http://spairum.my.id/' target='_blank'><img src='https://spairum.my.id/Asset/img/spairum.png' width='50%' border='0' /></a>
		            </td>
		        </tr>
		        <tr>
		            <td colspan='2' align='center' style='padding: 50px 50px 0px 50px;'>
		                <h1 style='padding-right: 0em; margin: 0; line-height: 40px; font-weight:300; font-family: 'Nunito Sans', Arial, Verdana, Helvetica, sans-serif; color: #666; text-align: left; padding-bottom: 1em;'>
		                    Email Spairum ini Untuk mengganti password akun
		                </h1>
		            </td>
		        </tr>
		        <tr>
		            <td style='text-align: left; padding: 0px 50px;' valign='top'>
		                <p style='font-size: 18px; margin: 0; line-height: 24px; font-family: 'Nunito Sans', Arial, Verdana, Helvetica, sans-serif; color: #666; text-align: left; padding-bottom: 3%;'>
		                    Hi $nama_depan $nama_belakang,
		                </p>
		                <p style='font-size: 18px; margin: 0; line-height: 24px; font-family: 'Nunito Sans', Arial, Verdana, Helvetica, sans-serif; color: #666; text-align: left; padding-bottom: 3%;'>
		                Untuk menganti password baru anda bisa klik tautan pada tautan dibawah :
		                </p>
		                <a href='https://app.spairum.my.id/auth/changepassword/$token' style='display:block;width:115px;height:25px;background:#0008ff;padding:10px;text-align:center;border-radius:5px;color:white;font-weight:bold'> Ganti Password sekarang</a>
						<br>
						<p>Atau Gunakan Kode </p>
						<h3>$kode</h3>
		                <p style='font-size: 18px; margin: 0; line-height: 24px; font-family: 'Nunito Sans', Arial, Verdana, Helvetica, sans-serif; color: #666; text-align: left; padding-bottom: 3%;'><br/>*Jangan pernah memberitahukan kode tersebut ke orang lain.</p>

						</td>
		        </tr>
		        <tr>
		            <td style='text-align: left; padding: 30px 50px 50px 50px' valign='top'>
		                <p style='font-size: 18px; margin: 0; line-height: 24px; font-family: 'Nunito Sans', Arial, Verdana, Helvetica, sans-serif; color: #505050; text-align: left;'>
		                    Thanks,<br/>
		                </p>
		            </td>
		        </tr>
		        <tr>
		            <td colspan='2' align='center' style='padding: 20px 40px 40px 40px;' bgcolor='#f0f0f0'>
		                <p style='font-size: 12px; margin: 0; line-height: 24px; font-family: 'Nunito Sans', Arial, Verdana, Helvetica, sans-serif; color: #777;'>
		                    &copy; 2020
		                    <a href='https://spairum.my.id/about' target='_blank' style='color: #777; text-decoration: none'>Spairum-Pay</a>
		                    <br>
		                    Jl.Merdeka, Pontianak - Kalimantan Barat
		                    <br>
		                    Indonesia
		                </p>
		            </td>
		        </tr>
		        </table>
		    </td>
		    </tr>
		    </table>
		    "
		);
		$this->email->send();
		session()->setFlashdata('Berhasil', 'Silakan cek kotak masuk email atau spam untuk verifikasi ganti password akun.');
		return redirect()->to('/auth/otplupa');
	}
	public function otplupa()
	{
		$data = [
			'title' => 'Change Password | Spairum.com',
			'validation' => \Config\Services::validation()
		];
		return view('/auth/otplupa', $data);
	}

	public function changepassword($link = NULL)
	{
		if (session()->get('token') == '') {
			session()->setFlashdata('gagal', 'Mau Kemana');
			return redirect()->to('/');
		}
		$cek = $this->OtpModel->cek($link);
		if (!empty($cek)) {
			$id_user = $cek['id_user'];

			$this->OtpModel->save([
				'id' => $cek['id'],
				'link' => substr(sha1($cek['link']), 0, 10),
				'status' => 'Password di ganti (Link)',
			]);
			// return view('/auth/change_password', $data);
			return redirect()->to('/auth/change_password');
		}


		$token = $this->request->getVar('otp');
		if (session()->get('token') == $token) {
			$id_user = session()->get('id');

			$cek = $this->OtpModel->cekid($id_user);

			$this->OtpModel->save([
				'id' => $cek['id'],
				'link' => substr(sha1($cek['link']), 0, 10),
				'status' => 'Password di ganti (OTP)',
			]);
			// return view('user/change_password', $data);
			return redirect()->to('/auth/change_password');
		}
	}

	public function change_password()
	{
		if (session()->get('token') == '') {
			session()->setFlashdata('gagal', 'Mau Kemana');
			return redirect()->to('/');
		}

		$id_user = session()->get('id');

		$akun = $this->UserModel->cek_id($id_user);
		$data = [
			'title' => 'Change Password | Spairum.com',
			'akun' => $akun,
			'validation' => \Config\Services::validation()
		];
		return view('auth/change_password', $data);
	}

	public function passwordupdate()
	{
		if (session()->get('token') == '') {
			session()->setFlashdata('gagal', 'Mau Kemana');
			return redirect()->to('/');
		}

		// if (!$this->validate([
		// 	'password_baru' => [
		// 		'rules'  => 'required|min_length[8]',
		// 		'errors' => [
		// 			'required' => '{field} wajid di isi',
		// 			'min_length[8]' => '{field} Minimal 8 karakter'
		// 		]
		// 	],
		// 	'password_ualangi' => [
		// 		'rules'  => 'required|matches[password]',
		// 		'errors' => [
		// 			'required' => 'password wajid di isi',
		// 			'matches' => 'password tidak sama'
		// 		]
		// 	]
		// ])) {
		// 	$validation = \config\Services::validation();
		// 	return redirect()->to('/auth/change_password')->withInput()->with('validation', $validation);
		// }

		$id_user = session()->get('id');
		$password = $this->request->getVar('password_ualangi');
		$user = $this->UserModel->cek_id($id_user);
		$cek = $this->OtpModel->cekid($id_user);
		$this->OtpModel->save([
			'id' => $cek['id'],
			'link' => substr(sha1($cek['link']), 0, 20),
			'password' => password_hash($password, PASSWORD_BCRYPT),
			'status' => 'Tercerivikasi Password Baru',
		]);
		$this->UserModel->save([
			'id' => $user['id'],
			'password' => password_hash($password, PASSWORD_BCRYPT),
		]);
		session_destroy();
		session()->setFlashdata('Berhasil', 'Password anda telah diperbaharui.');
		return redirect()->to('/');
	}
	public function tes()
	{
		$payload = array(
			"Key" => "Login Spairum",
			"User" => "password",
		);
		$jwt = JWT::encode($payload, self::$key,);
		$decoded = JWT::decode($jwt, self::$key, array('HS256'));

		print_r($decoded);
		print_r($jwt);
	}
}
