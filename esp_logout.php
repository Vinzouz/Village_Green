<?php

session_start();

$_SESSION["mail"] = array();
$_SESSION["grade"] = array();

session_unset($_SESSION["mail"]);
session_unset($_SESSION["grade"]);

if (ini_get("session.use_cookies")) {

    setcookie(session_name(), '', time() - 42000);
}

session_destroy();
header('Location: Accueil.php');
exit;

?>