<?php

namespace App\Controllers;

class page extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home | spairum'
        ];

        return   view('Home/profil', $data);
    }


    //--------------------------------------------------------------------

}
