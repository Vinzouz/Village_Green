<?php

$DB_HOST = '127.0.0.1'; // Addresse de connection à la DB
$DB_USER = 'root'; // Nom d'utilisateur DB
$DB_PASS = ''; // Mot de passe de l'utilisateur DB

$DB_NAME = 'villagegreen'; // Nom de la base de donnée qui gère les comptes
	
try 
{
    $db = new PDO('mysql:dbname='.$DB_NAME.';host='.$DB_HOST.'', $DB_USER, $DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (Exception $e) 
{
    echo 'Erreur : ' . $e->getMessage() . '<br />';
    echo 'N° : ' . $e->getCode();
    die('Fin du script');
} 

?>