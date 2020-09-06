<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table      = 'transaksi';
    protected $allowedFields    =
    [
        'id_user',
        'order_id',
        'harga',
        'bank',
        'va_code',
        'Biller_Code',
        'Bill_Key',
        'Payment_Code',
        'Merchant_Code',
        'User_Id',
        'status',
    ];
}
