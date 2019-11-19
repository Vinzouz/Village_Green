<?php

// Connexion a la BDD

$db= new PDO("mysql:host=localhost;dbname=villagegreen;charset=utf8","root","");


// Zones d'attribution de la saisie

$marque=$_POST["marque"];
$nom=$_POST["nom_prod"];
$prix=$_POST["prix"];
$description=$_POST["desc"];
$caract=$_POST["caract"];
$sousCategorie=$_POST["sel2"];
$stockQt=$_POST["stock_qt"];
$stockAl=$_POST["stock_al"];


// Zone test développement, a décommenter au besoin

// echo $_POST["marque"];
// echo "<br>";
// echo $_POST["nom_prod"];
// echo "<br>";
// echo $_POST["prix"];
// echo "<br>";
// echo $_POST["desc"];
// echo "<br>";
// echo $_POST["caract"];
// echo "<br>";
// echo $_POST["sel2"]; 
// echo "<br>";
// echo $_POST["stock_qt"];
// echo "<br>";
// echo $_POST["stock_al"];
// echo "<br>";

// Zone de définition des regex

$validMarque="/^[éèêA-Za-z]+[-]?[éèêA-Za-z]*$/";
$validDesc="/^[0-9éèêçA-Za-z.,: \-]+$/";
$validPrix="/^[0-9]*$/";
$validQt="/^[0-9]*$/";
$validAl="/^[0-9]*$/";
$validCaract="/^[0-9éèêçA-Za-z.,: \-]+$/";
$validNom="/^[0-9éèêçA-Za-z.,: \-]+$/";

// Zone de definition des flags de controle des regex

$flagMarque=0;
$flagDesc=0;
$flagPrix=0;
$flagQt=0;
$flagAl=0;
$flagNom=0;
$flagCaract=0;

// Zone de controle des regex

// Marque

if (preg_match($validMarque, $marque))
{
    $flagMarque=1;
}

else if (!preg_match($validMarque, $marque))
{
    $flagMarque=0;
}

// Prix

if (preg_match($validPrix, $prix))
{
    $flagPrix=1;
}

else if (!preg_match($validPrix, $prix))
{
    $flagPrix=0;
}

// Description

if (preg_match($validDesc, $description))
{
    $flagDesc=1;
}

else if (!preg_match($validDesc, $description))
{
    $flagDesc=0;
}

// Nom

if (preg_match($validNom, $nom))
{
    $flagNom=1;
}

else if (!preg_match($validNom, $nom))
{
    $flagNom=0;
}

// Stock QT

if (preg_match($validQt, $stockQt))
{
    $flagQt=1;
}

else if (!preg_match($validQt, $stockQt))
{
    $flagQt=0;
}

// Stock Al

if (preg_match($validAl, $stockAl))
{
    $flagAl=1;
}

else if (!preg_match($validAl, $stockAl))
{
    $flagAl=0;
}

// Caract

if (preg_match($validCaract, $caract))
{
    $flagCaract=1;
}

else if (!preg_match($validCaract, $caract))
{
    $flagCaract=0;
}



// Zones de vérification et d'addition à la base de donnée 
$sendOk=$flagMarque+$flagDesc+$flagPrix+$flagQt+$flagAl+$flagNom+$flagCaract;
if ($sendOk==7)
{
    $sendglobal= $db->prepare("INSERT INTO produit SET  produit_marque = ?, produit_nom = ?, produit_prix_HT = ?, produit_desc = ?, produit_caract = ?, produit_sousrub_id = ?, produit_qtite = ?, produit_qtite_ale = ?");
    $sendglobal->execute(array($marque, $nom, $prix, $description, $caract, $sousCategorie, $stockQt, $stockAl));
    Echo "Le produit a correctement était ajouté à la Base de Données.";
}
else if ($sendOk!=7)
{
    Echo "La vérification serveur n'a pas eu lieu suite à une erreur de regex, veuillez réutiliser le formulaire.";
}



// Zone de test a décommenter au besoin

// echo "<br>";
// echo $flagMarque;
// echo "<br>";
// echo $flagDesc;
// echo "<br>";
// echo $flagPrix;
// echo "<br>";
// echo $flagQt;
// echo "<br>";
// echo $flagAl;
// echo "<br>";
// echo $flagNom;
// echo "<br>";
// echo $flagCaract;
// echo "<br>";
?>
