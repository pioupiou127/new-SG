<?php

class Killbot
{
    function apikey($api_key){
        $this->apikey = $api_key;
    }

    function check(){
        $ip = $this->get_client_ip();
        $response = $this->httpGet("https://killbot.org/api/v1/blocker?ip=".$ip."&apikey=".$this->apikey."&ua=".urlencode($_SERVER['HTTP_USER_AGENT'])."&url=".urlencode($_SERVER['REQUEST_URI']));
        $json = json_decode($response, true);
        if ($json['data']['block_access'] == true){
            return true;
        } else {
            return false;
        }
    }

    function get_client_ip(){
        if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])){
            $_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_CF_CONNECTING_IP'];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER['HTTP_CF_CONNECTING_IP'];
        }
        $client = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote = @$_SERVER['REMOTE_ADDR'];
        if (filter_var($client, FILTER_VALIDATE_IP)){
            $ip = $client;
        }elseif (filter_var($forward, FILTER_VALIDATE_IP)){
            $ip = $forward;
        } else {
            $ip = $remote;
        }
        return $ip;
    }
    function httpGet($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERAGENT, "Killbot Blocker");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $response = curl_exec($ch);
        return $response;
    }

}