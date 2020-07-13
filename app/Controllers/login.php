<?php

namespace App\Controllers;

use App\Models\LoginModel;
use App\Controllers\Home;

class login extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->LoginModel = new LoginModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Login'
        ];
        return   view('auth/login', $data);
    }

    public function cek_login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $cek = $this->LoginModel->cek_login($username, $password);

        if (($cek['username'] == $username) && ($cek['password'] == $password)) {
            //jika username betul
            session()->set('username', $cek['username']);
            session()->set('Cv', $cek['Cv']);
            session()->set('Level', $cek['Level']);
            return redirect()->to(base_url(page));
        } else {
            //jika username dan password salah
            session()->setFlashdata('gagal', 'username atau password salah');
            return redirect()->to(base_url('login'));
        }
    }
}
