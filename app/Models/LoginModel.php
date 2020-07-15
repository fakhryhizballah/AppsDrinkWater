<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table      = 'user';
    public function cek_login($nama)
    {
        return $this->db->table('user')
            ->where(array('nama' => $nama))
            ->get()->getRowArray();
    }
}
