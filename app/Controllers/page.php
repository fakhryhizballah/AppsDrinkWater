<?php

namespace App\Controllers;

use App\Models\Stasiun as ModelsStasiun;

class page extends BaseController
{
    protected $stasiunModel;
    public function __construct()
    {
        $this->stasiunModel = new ModelsStasiun();
    }
    public function index()
    {
        if (session()->get('nama') == '') {
            session()->setFlashdata('gagal', 'Login dulu');
            return redirect()->to('/');
        }
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
        $stasiun = $this->stasiunModel->findAll();
        $data = [
            'title' => 'Explore | spairum',
            'page' => 'Explore',
            'stasiun' => $stasiun
        ];

        return   view('Home/explore', $data);
    }


    //--------------------------------------------------------------------

}
