<?php

namespace App\Controllers;

class page extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Profil | Spairum'
        ];

        return   view('Home/profil', $data);
    }
    public function History()
    {
        $data = [
            'title' => 'Riwayat | spairum'
        ];

        return   view('Home/History', $data);
    }


    //--------------------------------------------------------------------

}
