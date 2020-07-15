<?php

namespace App\Models;

use CodeIgniter\Model;

class userModel extends Model
{
    protected $table      = 'driver';
    protected $useTimestamps = true;
    protected $allowedFields = ['aID', 'nama', 'email', 'cv', 'telp', 'password'];
}
