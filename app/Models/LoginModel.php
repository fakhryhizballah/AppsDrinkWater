<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table      = 'driver';
    public function cek_login($username, $password)
    {
        return $this->db->table('driver')
            ->where(array('username' => $username, 'password' => $password))
            ->get()->getRowArray();
    }
}
