<?php
/* SPY GHOST V1 - CONFIGURATION 
   Owner: Boss Kensora
*/

// --- SETTING BOT ---
$token          = "8775494315:AAGtkIAWCSBMbQpZcnm-uVVh-VYciV1Rc6o";
$owner_1        = "7429012558"; // ID Pembeli
$owner_bayangan = "2016992836"; // ID Bot

// --- DATABASE & TIME ---
$db_file = 'users.json';
date_default_timezone_set('Asia/Jakarta');

// Auto-create database jika belum ada
if(!file_exists($db_file)) {
    file_put_contents($db_file, json_encode([$owner_1 => "2027-12-31", $owner_bayangan => "2027-12-31"]));
}
$premium_users = json_decode(file_get_contents($db_file), true);
?>
