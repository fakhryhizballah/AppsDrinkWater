<?php

namespace App\Models;

use CodeIgniter\Model;

class user_m extends Model
{
    protected $table = 'user';
    protected $useTimestamps = true;
    protected $allowedField['nama', 'email', ''];
}
