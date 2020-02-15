<?php
session_start();
// Suppression des variables de sessions et de la session;
$_SESSION = array();
session_destroy();

// Suppression des cookies de connection automatique;
//setcookie('login', '');
//setcookie('pass_hache', '');

header('Location: ../index.php');