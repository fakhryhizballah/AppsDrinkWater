<?php
\Midtrans\Config::$serverKey = "SB-Mid-server-OBUKKrJVEPM_WIpDt57XrGHp";

// Uncomment for production environment
// \Midtrans\Config::$isProduction = true;

// Enable sanitization
\Midtrans\Config::$isSanitized = true;

// Enable 3D-Secure
\Midtrans\Config::$is3ds = true;

$notif = new \Midtrans\Notification();

$transaction = $notif->transaction_status;
$type = $notif->payment_type;
$order_id = $notif->order_id;
$fraud = $notif->fraud_status;
var_dump($transaction);
