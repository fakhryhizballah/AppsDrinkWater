<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'user';
    // Uncomment below if you want add primary key
    // protected $primaryKey = 'id';
    protected $useTimestamps    = true;
    protected $allowedFields    =
    [
        'id_user',
        'nama',
        'email',
        'telp',
        'password',
        'profil',
        'debit',
        'kredit'
    ];

    public function cek_login($nama)
    {


        return $this->db->table('user')
            ->where(array('nama' => $nama))
            ->orWhere(array('email' => $nama))
            ->orWhere(array('telp' => $nama))
            ->get()->getRowArray();
    }
}
