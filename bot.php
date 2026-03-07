<?php
function kirimLaporan($id, $file, $cap) {
    global $token;
    $ch = curl_init("https://api.telegram.org/bot$token/sendPhoto");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
        'chat_id' => $id,
        'photo' => new CURLFile(realpath($file)),
        'caption' => $cap,
        'parse_mode' => 'Markdown'
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_exec($ch);
    curl_close($ch);
}
?>