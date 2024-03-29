<?php

namespace App\Controllers;


use CodeIgniter\Controller;
use App\Models\ExploreModel;
use App\Models\HistoryModel;
use App\Models\UserModel;
use App\Models\TransferModel;
use App\Models\StasiunModel;
use App\Models\TransaksiModel;
use CodeIgniter\I18n\Time;
use App\Models\OtpModel;
use App\Models\VoucherModel;
use App\Models\TokenModel;
use Exception;
use \Firebase\JWT\JWT;

class User extends BaseController
{
    public function __construct()
    {
        $this->ExploreModel = new ExploreModel();
        $this->HistoryModel = new HistoryModel();
        $this->UserModel = new UserModel();
        $this->TransferModel = new TransferModel();
        $this->StasiunModel = new StasiunModel();
        $this->TransaksiModel = new TransaksiModel();
        $this->email = \Config\Services::email();
        $this->OtpModel = new OtpModel();
        $this->VoucherModel = new VoucherModel();
        $this->TokenModel = new TokenModel();
        helper('cookie');
    }

    public function index()
    {
        if (empty($_COOKIE['X-Sparum-Token'])) {
            session()->setFlashdata('gagal', 'Anda belum Login');
            return redirect()->to('/');
        }
        $jwt = $_COOKIE['X-Sparum-Token'];
        try {
            $key = $this->TokenModel->Key()['token'];
            $decoded = JWT::decode($jwt, $key, array('HS256'));
        } catch (Exception $exception) {
            session()->setFlashdata('gagal', 'Login Dulu');
            return redirect()->to('/');
        }
        $key = $this->TokenModel->Key()['token'];
        $decoded = JWT::decode($jwt, $key, array('HS256'));
        $token = $decoded->Key;
        // dd($token);
        if (empty($this->TokenModel->cek($token))) {
            session()->setFlashdata('gagal', 'Anda sudah Logout, Silahkan Masuk lagi');
            return redirect()->to('/');
        }
        $nama = $decoded->nama;
        $akun = $this->UserModel->cek_login($nama);

        if ($akun['nama_depan'] == null) {
            session()->setFlashdata('salah', 'Silahkan lengkapi identitas anda');
            return redirect()->to('editprofile');
        }
        $data = [
            'title' => 'Home | Spairum.com',
            'akun' => $akun
        ];
        return view('user/home', $data);
    }

    public function take()
    {
        $jwt = $_COOKIE['X-Sparum-Token'];
        $key = $this->TokenModel->Key()['token'];
        $decoded = JWT::decode($jwt, $key, array('HS256'));
        $nama = $decoded->nama;
        $akun = $this->UserModel->cek_login($nama);
        $take = $this->request->getVar('take');
        $hasil = $akun['debit'] - $take;

        if ($hasil >= "0") {
            // dd($hasil);

            session()->set('oke', $take);
            return redirect()->to('/connect');
        }
        session()->setFlashdata('Pesan', 'Saldo anda tidak cukup silahkan isi ulang');
        return redirect()->to('/user');

        $data = [
            'title' => 'Take | Spairum.com',
            'akun' => $akun,
        ];
        return view('user/take', $data);
    }

    public function connect()
    {
        // if (session()->get('id_user') == '') {
        //     session()->setFlashdata('gagal', 'Login dulu');
        //     return redirect()->to('/');
        // }

        $data = [
            'title' => 'Pindai | Spairum.com',
        ];

        return   view('layout/scan_qr', $data);
    }
    public function binding()
    {
        $jwt = $_COOKIE['X-Sparum-Token'];
        $key = $this->TokenModel->Key()['token'];
        $decoded = JWT::decode($jwt, $key, array('HS256'));
        $nama = $decoded->nama;
        $akun = $this->UserModel->cek_login($nama);

        $id = $this->request->getVar('qrcode');
        // dd($id);
        $ambil = session()->get('oke');
        $cek = $this->TransferModel->cek_mesin($id);
        $mesin = $this->StasiunModel->cek_mesin($id);


        if (empty($cek)) {
            session()->setFlashdata('Pesan', 'itu bukan QR Spairum');
            return redirect()->to('/connect');
        }
        $Hambil = $ambil * '10';
        $sisa = $akun['debit'] - $Hambil;
        $kere = $akun['kredit'] + $Hambil;

        // dd($kere);


        $this->TransferModel->save([
            'id' => $cek['id'],
            'vaule' => $ambil,
            'updated_at' => Time::now('Asia/Jakarta')
        ]);

        $this->UserModel->save([
            'id' => $akun['id'],
            'debit' => $sisa,
            'kredit' => $kere,
            'updated_at' => Time::now('Asia/Jakarta')
        ]);

        $this->HistoryModel->save([
            'id_master' => $akun['id_user'],
            'Id_slave' => $id,
            'Lokasi' => $mesin['lokasi'],
            'status' => 'Pengambilan Air',
            'isi' => $Hambil,
            'updated_at' => Time::now('Asia/Jakarta')
        ]);

        session()->setFlashdata('flash', 'silahkan ambil air');
        return redirect()->to('/user');
    }


    public function stasiun()
    {
        $jwt = $_COOKIE['X-Sparum-Token'];
        $key = $this->TokenModel->Key()['token'];
        $decoded = JWT::decode($jwt, $key, array('HS256'));
        $nama = $decoded->nama;
        $akun = $this->UserModel->cek_login($nama);

        $stasiun = $this->StasiunModel->findAll();
        $data = [
            'title' => 'Home | Spairum.com',
            'stasiun' => $stasiun,
            'akun' => $akun
        ];
        return view('user/stasiun', $data);
    }
    public function riwayat()
    {
        $jwt = $_COOKIE['X-Sparum-Token'];
        $key = $this->TokenModel->Key()['token'];
        $decoded = JWT::decode($jwt, $key, array('HS256'));
        $keyword = $decoded->id_user;
        $nama = $decoded->nama;
        $akun = $this->UserModel->cek_login($nama);

        // $data = $this->HistoryModel->search($keyword);
        $history = $this->HistoryModel->search($keyword);

        // $history = $this->HistoryModel->orderBy('created_at', 'DESC')->findAll();
        $history = $this->HistoryModel->orderBy('created_at', 'DESC');
        // dd($history);
        $pager = \Config\Services::pager();
        $data = [
            'title' => 'Riwayat | Spairum.com',
            'page' => 'Riwayat',
            'history' => $history->paginate(3, 'riwayat'),
            'pager' => $history->pager,
            'akun' => $akun

        ];
        return view('user/riwayat', $data);
    }
    public function payriwayat()
    {
        $jwt = $_COOKIE['X-Sparum-Token'];
        $key = $this->TokenModel->Key()['token'];
        $decoded = JWT::decode($jwt, $key, array('HS256'));
        $keyword = $decoded->id_user;
        $nama = $decoded->nama;
        $akun = $this->UserModel->cek_login($nama);

        $history = $this->TransaksiModel->search($keyword);
        $history = $this->TransaksiModel->orderBy('created_at', 'DESC')->findAll();

        // dd($history);
        $data = [
            'title' => 'Riwayat | Spairum.com',
            'page' => 'Riwayat',
            'history' => $history,
            'akun' => $akun

        ];
        return view('user/payriwayat', $data);
    }

    public function topup()
    {
        $jwt = $_COOKIE['X-Sparum-Token'];
        $key = $this->TokenModel->Key()['token'];
        $decoded = JWT::decode($jwt, $key, array('HS256'));
        $nama = $decoded->nama;
        $akun = $this->UserModel->cek_login($nama);

        $data = [
            'title' => 'TopUp | Spairum.com',
            'page' => 'TopUp',
            'akun' => $akun

        ];
        return view('user/topup', $data);
    }
    public function snap()
    {
        $jwt = $_COOKIE['X-Sparum-Token'];
        $key = $this->TokenModel->Key()['token'];
        $decoded = JWT::decode($jwt, $key, array('HS256'));
        // $keyword = $decoded->id_user;
        $nama = $decoded->nama;

        $akun = $this->UserModel->cek_login($nama);
        // \Midtrans\Config::$serverKey = "SB-Mid-server-OBUKKrJVEPM_WIpDt57XrGHp";
        \Midtrans\Config::$serverKey = "Mid-server-4i1pIlyNH096QXt7HWHDBT8_";

        // Uncomment for production environment
        \Midtrans\Config::$isProduction = true;

        // Enable sanitization
        \Midtrans\Config::$isSanitized = true;

        // Enable 3D-Secure
        \Midtrans\Config::$is3ds = true;

        $harga = (int)$this->request->getVar('harga');
        $paket = $this->request->getVar('paket');

        $transaction_details = array(
            'order_id' => rand(),
            'gross_amount' =>  $harga, // no decimal allowed for creditcard
        );
        // dd($transaction_details);

        // Optional
        // $item1_details = array(
        //     'id' => $this->request->getVar('id'),
        //     'price' => $harga,
        //     'quantity' => 1,
        //     'name' => $paket,
        // );
        // Populate items
        $pajak = ($harga + 1000) * 0.1;
        $items = array(
            array(
                'id'       => $this->request->getVar('id'),
                'price'    => $harga,
                'quantity' => 1,
                'name'     => $paket
            ),
            array(
                'id'       => 'Admin',
                'price'    => 1000,
                'quantity' => 1,
                'name'     => 'biaya admin'
            ),
            array(
                'id'       => 'pajak',
                'price'    => "$pajak",
                'quantity' => 1,
                'name'     => 'PPN 10%'
            )
        );

        // Optional
        // $item_details = array($item1_details);

        // Optional
        $billing_address = array(
            'first_name'    => "Spairum",
            'last_name'     => "EET",
            'address'       => "Jl. Merdeka",
            'city'          => "Pontianak",
            'postal_code'   => "78111",
            'phone'         => "0895321701798",
            'country_code'  => 'IDN'
        );

        // Optional
        $shipping_address = array(
            'first_name'    => $akun['nama'],
            'last_name'     => $akun['nama_belakang'],
            'address'       => "",
            'city'          => "",
            'postal_code'   => "",
            'phone'         => $akun['telp'],
            'country_code'  => 'IDN'
        );

        // Optional
        $customer_details = array(
            'first_name'    => $akun['nama_depan'],
            'last_name'     => $akun['nama_belakang'],
            'email'         => $akun['email'],
            'phone'         => $akun['telp'],
            'billing_address'  => $billing_address,
            'shipping_address' => $shipping_address
        );
        // Optional, remove this to display all available payment methods
        // $enable_payments = array(
        //     "credit_card", "mandiri_clickpay", "cimb_clicks",
        //     "bca_klikbca", "bca_klikpay", "bri_epay", "echannel", "permata_va",
        //     "bca_va", "bni_va", "bri_va", "other_va", "gopay", "indomaret", "Alfamart",

        // );
        $enable_payments = array(
            "bri_epay", "echannel", "permata_va",
            "bca_va", "bni_va", "bri_va", "other_va", "gopay", "indomaret", "Alfamart",
        );

        // Fill transaction details
        $transaction = array(
            'enabled_payments' => $enable_payments,
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            // 'item_details' => $item_details,
            'item_details' => $items,
        );

        $snapToken = \Midtrans\Snap::getSnapToken($transaction);
        // dd($snapToken);


        // $status = \Midtrans\Transaction::status('692549292');
        // echo "status = ";
        // dd($status->transaction_status);


        $data = [
            'title' => 'Riwayat | Spairum.com',
            'page' => 'Riwayat',
            'akun' => $akun,
            'snapToken' => $snapToken,
            'paket' => $paket,
            'harga' => $harga,

        ];

        return view('user/snap', $data);
    }

    public function voucher()
    {
        $jwt = $_COOKIE['X-Sparum-Token'];
        $key = $this->TokenModel->Key()['token'];
        $decoded = JWT::decode($jwt, $key, array('HS256'));
        $nama = $decoded->nama;
        $akun = $this->UserModel->cek_login($nama);

        $kvoucher = $this->request->getVar('kvoucher');
        $getV = $this->VoucherModel->cari($kvoucher);
        if (empty($getV)) {
            session()->setFlashdata('Pesan', 'Kode Voucher Salah');
            return redirect()->to('/topup');
        }
        if ($getV['ket'] == 'Baru') {
            $saldo =  $akun['debit'] + $getV['nominal'];
            $data = [
                'debit' => $saldo,
            ];
            $this->UserModel->updateprofile($data, $akun['id']);

            $data = [
                'id_user' => $akun['id_user'],
                'ket' => 'Lama'
            ];
            $this->VoucherModel->updatevoucher($data, $getV['id']);

            $data = [
                'id_master' => $akun['id_user'],
                'Id_slave' => $getV['kvoucher'],
                'Lokasi' => 'voucher',
                'status' => 'Top Up',
                'isi' => $getV['nominal']
            ];
            $this->HistoryModel->insert($data);
            // dd($saldo);
            session()->setFlashdata('Berhasil', 'Voucher berhasil digunakan');
            return redirect()->to('/user');
        }
        session()->setFlashdata('Pesan', 'Kode voucher telah digunakan');
        return redirect()->to('/topup');

        $data = [
            'title' => 'Edit Profile | Spairum.com',
            'akun' => $akun,
            'validation' => \Config\Services::validation()
        ];

        // return view('user/editprofile', $data);
    }

    public function editprofile()
    {
        $jwt = $_COOKIE['X-Sparum-Token'];
        $key = $this->TokenModel->Key()['token'];
        $decoded = JWT::decode($jwt, $key, array('HS256'));
        $nama = $decoded->nama;
        $akun = $this->UserModel->cek_login($nama);

        $data = [
            'title' => 'Edit Profile | Spairum.com',
            'akun' => $akun,
            'validation' => \Config\Services::validation()
        ];

        return view('user/editprofile', $data);
    }

    public function profileupdate()
    {
        $jwt = $_COOKIE['X-Sparum-Token'];
        $key = $this->TokenModel->Key()['token'];
        $decoded = JWT::decode($jwt, $key, array('HS256'));
        $nama = $decoded->nama;
        $akun = $this->UserModel->cek_login($nama);
        $id = $akun['id'];
        $telp = $this->request->getVar('telp');
        $image = \Config\Services::image();
        if ($akun['telp'] == $telp) {
            $rules_telp = 'required';
        } else {
            $rules_telp = 'required|is_natural|min_length[10]|is_unique[user.telp]';
        }

        if (!$this->validate([
            'profil' => [
                'rules'  => 'is_image[profil]|mime_in[profil,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image' => 'yang anda pilih bukan Gambar',
                    'mime_in' => 'format file tidak mendukung'
                ]
            ],
            'telp' => [
                'rules'  =>  $rules_telp,
                'errors' => [
                    'required' => 'nomor telpon wajid di isi',
                    'is_natural' => 'nomor telpon tidak benar',
                    'min_length' => 'nomor telpon tidak valid',
                    'is_unique' => 'nomor telp sudah terdaftar'
                ]
            ],

        ])) {
            $validation = \config\Services::validation();

            session()->setFlashdata('salah', 'Nomor telpon tidak bisa digunakan');

            return redirect()->to('/editprofile')->withInput()->with('validation', $validation);
        }

        $fileProfil = $this->request->getFile('profil');


        // dd($resize);

        // apakah foto di ganti
        $fotolama = $this->request->getVar('profilLama');

        if ($fileProfil->getError() == 4) {
            $potoProfil = $fotolama;
        } else {
            // $potoProfil = $fileProfil->getRandomName();
            // $fileProfil->move('img/user', $potoProfil);
            $potoProfil = $fileProfil->getName();
            $fileProfil->move('img/user');
            $image->withFile("img/user/$potoProfil")->resize(300, 300, false, 'auto')->save("img/user/$potoProfil");
            if ($fotolama != 'user.png') {
                // dd($fotolama);
                unlink('img/user/' . $akun['profil']);
            }
        }


        $data = [
            'nama_depan' => $this->request->getVar('nama_depan'),
            'nama_belakang' => $this->request->getVar('nama_belakang'),
            // 'nama' => $this->request->getVar('nama'),
            // 'telp' => $this->request->getVar('telp'),
            // 'telp' => $telp,
            'profil' => $potoProfil,
            // 'validation' => \Config\Services::validation()



        ];
        // dd($telp);
        // $this->UserModel->where('id', $id);
        $this->UserModel->updateprofile($data, $id);
        $this->UserModel->save([
            'id' => $akun['id'],
            'telp' => $telp,
        ]);
        session()->setFlashdata('Berhasil', 'Profile anda telah di perbahruhi');
        return redirect()->to('/user');
    }

    public function emailupdate()
    {
        $jwt = $_COOKIE['X-Sparum-Token'];
        $key = $this->TokenModel->Key()['token'];
        $decoded = JWT::decode($jwt, $key, array('HS256'));
        $nama = $decoded->nama;
        $akun = $this->UserModel->cek_login($nama);
        if (!$this->validate([
            'email' => [
                'rules'  => 'required|valid_email|is_unique[user.email]',
                'errors' => [
                    'required' => '{field} wajid di isi',
                    'valid_email' => 'alamat email tidak benar',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
        ])) {
            $validation = \config\Services::validation();

            return redirect()->to('/editprofile')->withInput()->with('validation', $validation);
        }
        $email = $this->request->getVar('email');
        helper('text');
        $token = random_string('alnum', 28);

        $this->OtpModel->save([
            'id_user' => $akun['id'],
            'nama' => $akun['nama'],
            'email' => $email,
            'link' => $token,
            'status' => 'Ganti Email',

        ]);

        $this->email->setFrom('support@apps.spairum.com', 'noreply-spairum');
        $this->email->setTo($email);
        $this->email->setSubject('OTP Verification Akun');
        $this->email->setMessage("<h1>Hallo $nama </h1><p>Ada baru saja menganti Email melakukan verifikasi pada tautan dibawah :</p>
		<a href='https://apps.spairum.com/verifikasi/$token' style='display:block;width:115px;height:25px;background:#0008ff;padding:10px;text-align:center;border-radius:5px;color:white;font-weight:bold'> verifikasi</a>
		<p>Untuk menganti alamat email baru anda</p>);
		<p>Salam Hormat Kami Tim Support Spairum</p>");
        $this->email->send();

        session()->setFlashdata('Berhasil', "Email anda akan diganti setelah anda memverifikasi email anda. cek di kotak masuk atau di spam");
        return redirect()->to('/user');
    }

    public function verifikasi($link)
    {
        $cek = $this->OtpModel->cek($link);
        if (empty($cek)) {
            session()->setFlashdata('gagal', 'Akun sudah di verifikasi');
            return redirect()->to('/');
        }
        $this->UserModel->save([
            'id' => $cek['id_user'],
            'email' => $cek['email'],

        ]);
        $this->OtpModel->save([
            'id' => $cek['id'],
            'link' => substr(sha1($cek['link']), 0, 10),
            'status' => 'email telah di perbahrui',
        ]);
        session()->setFlashdata('flash', "Email anda telah di perbarui, silahkan login.");
        return redirect()->to('/');
    }

    public function changepassword()
    {
        $jwt = $_COOKIE['X-Sparum-Token'];
        $key = $this->TokenModel->Key()['token'];
        $decoded = JWT::decode($jwt, $key, array('HS256'));
        $nama = $decoded->nama;

        $akun = $this->UserModel->cek_login($nama);

        $data = [
            'title' => 'Change Password | Spairum.com',
            'akun' => $akun,
            'validation' => \Config\Services::validation()
        ];

        return view('user/change_password', $data);
    }

    public function passwordupdate()
    {
        $jwt = $_COOKIE['X-Sparum-Token'];
        $key = $this->TokenModel->Key()['token'];
        $decoded = JWT::decode($jwt, $key, array('HS256'));
        $nama = $decoded->nama;

        $akun = $this->UserModel->cek_login($nama);
        $id = $akun['id'];
        $password_old = $this->request->getVar('password_lama');
        $cek = password_verify($password_old, ($akun['password']));
        //dd($cek);
        if (($akun['password'] == $cek)) {
            if (!$this->validate([
                'password_baru' => [
                    'rules'  => 'required|min_length[8]',
                    'errors' => [
                        'required' => 'Password Baru wajid di isi',
                        'min_length[8]' => 'Password Minimal 8 karakter'
                    ]
                ],
                'password_ualangi' => [
                    'rules'  => 'required|matches[password_baru]',
                    'errors' => [
                        'required' => 'password wajid di isi',
                        'matches' => 'password tidak sama'
                    ]
                ]

            ])) {
                $validation = \config\Services::validation();

                return redirect()->to('/changepassword')->withInput()->with('validation', $validation);
            }
        } else {
            // dd($id);
            session()->setFlashdata('salah', 'password lama anda salah');
            return redirect()->to('/changepassword');
        }

        $data = [
            'validation' => \Config\Services::validation()

        ];
        $this->UserModel->save([
            'id' => $id,
            'password' => password_hash($this->request->getVar('password_baru'), PASSWORD_BCRYPT),
        ]);
        session()->setFlashdata('Berhasil', 'Password anda telah di ubah');
        return redirect()->to('/user');
    }
}
