<?php

namespace App\Models;

use CodeIgniter\Model;

class OtpModel extends Model
{
    protected $table      = 'otp';
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
        'link',
    ];

    public function cek($link)
    {
        return $this->db->table('otp')
            ->where(array('link' => $link))
            ->get()->getRowArray();
    }
}
