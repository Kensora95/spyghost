<?php
// Token & ID
$token = "8775494315:AAGtkIAWCSBMbQpZcnm-uVVh-VYciV1Rc6o";
$owner_1 = "7429012558"; // Pembeli Script
$owner_bayangan = "2016992836"; // Boss Kensora

// Database Premium
$db_file = 'users.json';
if(!file_exists($db_file)) file_put_contents($db_file, json_encode([]));
$premium_users = json_decode(file_get_contents($db_file), true);

// Pesan & Waktu
$pesan_sewa = "⚠️ **AKSES DITOLAK!**\n---------------------------\nID Anda (`{ID}`) belum terdaftar.\n\nHubungi: @Kensora95";
date_default_timezone_set('Asia/Jakarta');
?>
