<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ExploreModel;
use App\Models\HistoryModel;
use App\Models\UserModel;

class User extends Controller
{
    public function __construct()
    {
        $this->ExploreModel = new ExploreModel();
        $this->HistoryModel = new HistoryModel();
        $this->UserModel = new UserModel();
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
        $hasi = $akun['debit'] - $take;
        $data = [
            'title' => 'Take | Spairum.com',
            'akun' => $akun

        ];

        return   view('user/take', $data);
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

        // $data = $this->HistoryModel->search($keyword);
        $history = $this->HistoryModel->search($keyword);

        $history = $this->HistoryModel->findAll();
        //d($history);
        $data = [
            'title' => 'Riwayat | Spairum.com',
            'page' => 'Riwayat',
            'history' => $history

        ];
        return   view('user/riwayat', $data);
    }
}
