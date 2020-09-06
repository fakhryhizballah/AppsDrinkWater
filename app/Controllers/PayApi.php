<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;
use CodeIgniter\RESTful\ResourceController;
use App\Models\TransaksiModel;

use CodeIgniter\Controller;

class PayApi extends ResourceController
{
    protected $format = 'json';
    protected $modelName = 'App\Models\TransaksiModel';

    public function index()
    {
        $id = $this->request->getVar('order_id');
        \Midtrans\Config::$serverKey = "SB-Mid-server-OBUKKrJVEPM_WIpDt57XrGHp";

        // Uncomment for production environment
        // Config::$isProduction = true;

        // Enable sanitization
        \Midtrans\Config::$isSanitized = true;

        // Enable 3D-Secure
        \Midtrans\Config::$is3ds = true;

        $notif = \Midtrans\Transaction::status($id);

        // dd($id_order);
        if (session()->get('id_user') == '') {
            session()->setFlashdata('gagal', 'Login dulu');
            return redirect()->to('/');
        }
        $keyword = session()->get('id_user');
        $nama = session()->get('nama');
        $akun = $this->UserModel->cek_login($nama);


        $transaction = $notif->transaction_status;
        $harga = $notif->gross_amount;
        $order_id = $notif->order_id;
        $type = $notif->payment_type;
        // dd($notif);

        if ($type == "bank_transfer") {
            if (!empty($notif->permata_va_number)) {
                $kode = $notif->permata_va_number;
                $bank = "Transfer bank kode bank 013";
                dd($bank);
            }
            $bank = $notif->va_numbers[0]->bank;
            $kode = $notif->va_numbers[0]->va_number;
            dd($bank);
        }
        if ($type == "cstore") {
            $bank = $notif->store;
            $kode = $notif->payment_code;
            $this->TransaksiModel->save([
                'id_user' => $keyword,
                'order_id' => $id,
                'harga' = $harga,
                'bank' => $bank,
                'Payment_Code' => $kode,
                'Merchant_Code' => "G842103672",


            ]);
        }
        if ($type == "gopay") {
            $bank = $type;
            // $kode = $notif->payment_code;
            dd($bank);
        }
        if ($type == "bca_klikpay") {
            $bank = $type;
            // $kode = $notif->payment_code;
            dd($bank);
        }





        // $fraud = $notif->fraud_status;
    }
}
