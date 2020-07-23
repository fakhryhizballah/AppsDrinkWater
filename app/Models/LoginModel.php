<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table      = 'driver';

    public function cek_login($nama)
    {
        return $this->db->table('driver')
            // ->where(array('nama' => $nama, 'password' => $password))
            ->where(array('nama' => $nama))
            ->get()->getRowArray();
    }
}
