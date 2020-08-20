<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AdminModel;
use App\Models\DriverModel;
use App\Models\UserModel;
use App\Models\StasiunModel;



class Admin extends Controller
{
    public function __construct()
    {
        $this->AdminModel = new AdminModel();
        $this->DriverModel = new DriverModel();
        $this->UserModel = new UserModel();
        $this->StasiunModel = new StasiunModel();
    }
    public function index()
    {
        if (session()->get('id_akun') == '') {
            session()->setFlashdata('gagal', 'Login dulu');
            return redirect()->to('/');
        }
        $nama = session()->get('nama');
        $akun = $this->AdminModel->cek_login($nama);
        //dd($akun);
        $data = [
            'title' => 'Dashboard',
            'akun' => $akun

        ];
        return view('admin/index', $data);
    }

    public function admdriver()
    {
        $driver = $this->DriverModel->findAll();
        $data = [
            'title' => 'Driver',
            'driver' => $driver
        ];
        return view('admin/driver', $data);
    }

    public function ptcv()
    {
        $data = [
            'title' => 'PT / CV'
        ];
        return view('admin/ptcv', $data);
    }

    public function admuser()
    {
        $user = $this->UserModel->findAll();
        $data = [
            'title' => 'User',
            'user' => $user
        ];
        return view('admin/user', $data);
    }

    public function admstasiun()
    {
        $stasiun = $this->StasiunModel->findAll();
        $data = [
            'title' => 'Stasiun',
            'stasiun' => $stasiun
        ];
        return view('admin/stasiun', $data);
    }

    public function crtmitra()
    {
        $data = [
            'title' => 'Create Mitra'
        ];
        return view('admin/crt_mitra', $data);
    }

    public function crtdriver()
    {
        $data = [
            'title' => 'Create Driver'
        ];
        return view('admin/crt_driver', $data);
    }

    public function crtstasiun()
    {
        $data = [
            'title' => 'Create Stasiun'
        ];
        return view('admin/crt_stasiun', $data);
    }
}
