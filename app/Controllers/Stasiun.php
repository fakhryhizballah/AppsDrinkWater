<?php

namespace App\Controllers;

use App\Models\Stasiun as ModelsStasiun;

class Stasiun extends BaseController
{
    protected $stasiunModel;
    public function __construct()
    {
        $this->stasiunModel = new ModelsStasiun();
    }
    public function index()
    {
        // $stasiunModel = new ModelsStasiun();
        // $stasiun = $stasiunModel->findAll();
        $stasiun = $this->stasiunModel->findAll();
        $data = [
            'title' => 'Explore | Spairum',
            'stasiun' => $stasiun
        ];


        return view('Stasiun/index', $data);
    }
}
