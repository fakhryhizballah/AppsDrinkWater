<?php

namespace App\Controllers;

class page extends BaseController
{
    public function index()
    {
        echo view('layout/header');
        echo view('Home/home');
        echo view('layout/footer');
    }


    //--------------------------------------------------------------------

}
