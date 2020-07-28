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
            'title' => 'PT/CV'
        ];
        return view('admin/ptcv', $data);
    }
}
