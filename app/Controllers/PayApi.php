<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;
use CodeIgniter\RESTful\ResourceController;
use App\Models\TransaksiModel;
use App\Models\HistoryModel;
use App\Models\UserModel;

use CodeIgniter\Controller;

class PayApi extends ResourceController
{
    protected $format = 'json';
    protected $modelName = 'App\Models\TransaksiModel';

    public function __construct()
    {
        $this->HistoryModel = new HistoryModel();
        $this->UserModel = new UserModel();
        $this->TransaksiModel = new TransaksiModel();
    }


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
            $updated_at = Time::now('Asia/Jakarta');
            $this->TransaksiModel->save([
                'id_user' => $keyword,
                'order_id' => $id,
                'harga' => $harga,
                'bank' => $bank,
                'Payment_Code' => $kode,
                'Merchant_Code' => "G842103672",
                'created_at' => $updated_at,
                'updated_at' => $updated_at,
            ]);
            session()->setFlashdata('Pesan', 'Silahkan Lakukan Pembayaran di alfamart');
            return redirect()->to('/history');
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
