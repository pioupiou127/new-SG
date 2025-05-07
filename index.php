<?php

session_start();

# User Agent

$useragent = $_SERVER['HTTP_USER_AGENT'];

# Anti Bots 

# Check User-Agents
header('location: connexion.php');
?>