#!/data/data/com.termux/files/usr/bin/bash
echo "Installing Spy Ghost..."
pkg update && pkg upgrade -y
pkg install php -y
pkg install cloudflared -y
echo "Installation Complete! Jalankan dengan: php -S 127.0.0.1:8080"
