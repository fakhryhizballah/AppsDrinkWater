<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AdminModel;
use App\Models\UserModel;
use App\Models\ExploreModel;
use App\Models\StasiunModel;


class Admin extends Controller
{
    public function __construct()
    {
        $this->AdminModel = new AdminModel();
        $this->UserModel = new UserModel();
        $this->ExploreModel = new ExploreModel();
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
        $tuser = $this->UserModel->findAll();
        $tstasiun = $this->StasiunModel->findAll();
        //dd($akun);
        $data = [
            'title' => 'Dashboard',
            'akun' => $akun,
            'tuser' => $tuser,
            'tstasiun' => $tstasiun
        ];
        return view('admin/index', $data);
    }

    public function admdriver()
    {
        if (session()->get('id_akun') == '') {
            session()->setFlashdata('gagal', 'Login dulu');
            return redirect()->to('/');
        }
        $nama = session()->get('nama');
        $akun = $this->AdminModel->cek_login($nama);
        $driver = $this->DriverModel->findAll();
        $data = [
            'title' => 'Driver',
            'akun' => $akun,
            'driver' => $driver
        ];
        return view('admin/driver', $data);
    }

    public function ptcv()
    {
        if (session()->get('id_akun') == '') {
            session()->setFlashdata('gagal', 'Login dulu');
            return redirect()->to('/');
        }
        $nama = session()->get('nama');
        $akun = $this->AdminModel->cek_login($nama);
        $data = [
            'title' => 'PT / CV',
            'akun' => $akun
        ];
        return view('admin/ptcv', $data);
    }

    public function admuser()
    {
        $UserModel = $this->UserModel;
        $user = $UserModel->paginate(5, 'user');

        // dd($user);
        $data = [
            'title' => 'User',
            'user' => $user,
            'pager' => $UserModel->pager,

        ];
        return view('admin/user', $data);
    }

    public function admstasiun()
    {
        $stasiun = $this->StasiunModel;
        $data = [
            'title' => 'Stasiun',
            'stasiun' => $stasiun->paginate(5, 'stasiun'),
            'pager' => $stasiun->pager,

        ];
        return view('admin/stasiun', $data);
    }

    public function crtmitra()
    {
        if (session()->get('id_akun') == '') {
            session()->setFlashdata('gagal', 'Login dulu');
            return redirect()->to('/');
        }
        $nama = session()->get('nama');
        $akun = $this->AdminModel->cek_login($nama);
        $data = [
            'title' => 'Create Mitra',
            'akun' => $akun
        ];
        return view('admin/crt_mitra', $data);
    }

    public function crtdriver()
    {
        if (session()->get('id_akun') == '') {
            session()->setFlashdata('gagal', 'Login dulu');
            return redirect()->to('/');
        }
        $nama = session()->get('nama');
        $akun = $this->AdminModel->cek_login($nama);
        $data = [
            'title' => 'Create Driver',
            'akun' => $akun
        ];
        return view('admin/crt_driver', $data);
    }

    public function crtstasiun()
    {
        if (session()->get('id_akun') == '') {
            session()->setFlashdata('gagal', 'Login dulu');
            return redirect()->to('/');
        }
        $nama = session()->get('nama');
        $akun = $this->AdminModel->cek_login($nama);
        $data = [
            'title' => 'Create Stasiun',
            'akun' => $akun
        ];
        return view('admin/crt_stasiun', $data);
    }
}
