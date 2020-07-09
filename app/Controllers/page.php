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
            'title' => 'Riwayat | spairum',
            'page' => 'Riwayat'
        ];

        return   view('Home/History', $data);
    }
    public function explore()
    {
        $data = [
            'title' => 'Explore | spairum',
            'page' => 'Explore'
        ];

        return   view('Home/explore', $data);
    }


    //--------------------------------------------------------------------

}
