<?php

namespace App\Controllers;


class Admin extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard'
        ];
        return view('admin/index', $data);
    }

    public function admdriver()
    {
        $data = [
            'title' => 'Driver'
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
        $data = [
            'title' => 'User'
        ];
        return view('admin/user', $data);
    }

    public function admstasiun()
    {
        $data = [
            'title' => 'Stasiun'
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
