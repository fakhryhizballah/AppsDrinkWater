<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ExploreModel;
use App\Models\HistoryModel;
use App\Models\UserModel;
use App\Models\TransferModel;
use App\Models\StasiunModel;
use CodeIgniter\I18n\Time;

class User extends Controller
{
    public function __construct()
    {
        $this->ExploreModel = new ExploreModel();
        $this->HistoryModel = new HistoryModel();
        $this->UserModel = new UserModel();
        $this->TransferModel = new TransferModel();
        $this->StasiunModel = new StasiunModel();
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

        return   view('user/home', $data);
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
        // dd($hasil);


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
        return   view('user/take', $data);
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
        $data = [
            'title' => 'Home | Spairum.com',
        ];
        return   view('user/stasiun', $data);
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

        $history = $this->HistoryModel->findAll();
        //d($history);
        $data = [
            'title' => 'Riwayat | Spairum.com',
            'page' => 'Riwayat',
            'history' => $history,
            'akun' => $akun

        ];
        return   view('user/riwayat', $data);
    }
}
