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
    }

    public function index()
    {
        if (session()->get('id_user') == '') {
            session()->setFlashdata('gagal', 'Login dulu');
            return redirect()->to('/');
        }
        $nama = session()->get('nama');
        $akun = $this->UserModel->cek_login($nama);
        //dd($akun);
        $data = [
            'title' => 'Home | Spairum.com',
            'akun' => $akun

        ];

        return view('user/home', $data);
    }

    public function take()
    {
        if (session()->get('id_user') == '') {
            session()->setFlashdata('gagal', 'Login dulu');
            return redirect()->to('/');
        }
        $nama = session()->get('nama');
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
        if (session()->get('id_user') == '') {
            session()->setFlashdata('gagal', 'Login dulu');
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Pindai | Spairum.com',
        ];

        return   view('layout/scan_qr', $data);
    }
    public function binding()
    {
        if (session()->get('id_user') == '') {
            session()->setFlashdata('gagal', 'Login dulu');
            return redirect()->to('/');
        }
        $nama = session()->get('nama');
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

        $sisa = $akun['debit'] - $ambil;
        $kere = $akun['kredit'] + $ambil;
        $Hambil = $ambil * '10';
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
        if (session()->get('id_user') == '') {
            session()->setFlashdata('gagal', 'Login dulu');
            return redirect()->to('/');
        }
        $nama = session()->get('nama');
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
        if (session()->get('id_user') == '') {
            session()->setFlashdata('gagal', 'Login dulu');
            return redirect()->to('/');
        }
        $keyword = session()->get('id_user');
        $nama = session()->get('nama');
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
        if (session()->get('id_user') == '') {
            session()->setFlashdata('gagal', 'Login dulu');
            return redirect()->to('/');
        }
        $keyword = session()->get('id_user');
        $nama = session()->get('nama');
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
        if (session()->get('id_user') == '') {
            session()->setFlashdata('gagal', 'Login dulu');
            return redirect()->to('/');
        }
        $nama = session()->get('nama');
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
        if (session()->get('id_user') == '') {
            session()->setFlashdata('gagal', 'Login dulu');
            return redirect()->to('/');
        }
        $keyword = session()->get('id_user');
        $nama = session()->get('nama');
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
        $item1_details = array(
            'id' => $this->request->getVar('id'),
            'price' => $harga,
            'quantity' => 1,
            'name' => $paket,
        );

        // Optional
        $item_details = array($item1_details);

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
            'last_name'     => " ",
            'address'       => "",
            'city'          => "",
            'postal_code'   => "",
            'phone'         => $akun['telp'],
            'country_code'  => 'IDN'
        );

        // Optional
        $customer_details = array(
            'first_name'    => $akun['nama'],
            'last_name'     => '',
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
            'item_details' => $item_details,
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

    public function editprofile()
    {
        if (session()->get('id_user') == '') {
            session()->setFlashdata('gagal', 'Login dulu');
            return redirect()->to('/');
        }
        $nama = session()->get('nama');
        $akun = $this->UserModel->cek_login($nama);

        $data = [
            'title' => 'Edit Profile | Spairum.com',
            'akun' => $akun
        ];

        return view('user/editprofile', $data);
    }

    public function changepassword()
    {
        if (session()->get('id_user') == '') {
            session()->setFlashdata('gagal', 'Login dulu');
            return redirect()->to('/');
        }
        $nama = session()->get('nama');
        $akun = $this->UserModel->cek_login($nama);

        $data = [
            'title' => 'Change Password | Spairum.com',
            'akun' => $akun
        ];

        return view('user/change_password', $data);
    }
}
