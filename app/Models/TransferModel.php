<?php

namespace App\Models;

use CodeIgniter\Model;

class TransferModel extends Model
{
    protected $table      = 'transfer';
    protected $useTimestamps    = true;
    protected $allowedFields    = ['id_slave', 'vaule'];

    public function cek_mesin($id_slave)
    {
        return $this->db->table('transfer')
            ->where(array('id_slave' => $id_slave))
            ->get()->getRowArray();
    }
}
