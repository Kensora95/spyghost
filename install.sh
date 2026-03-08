#!/data/data/com.termux/files/usr/bin/bash
echo "--- SPY GHOST INSTALLER ---"
pkg update && pkg upgrade -y
pkg install php git cloudflared -y
echo "--- INSTALL SUCCESS ---"
echo "Jalankan server: php -S 127.0.0.1:8080"
