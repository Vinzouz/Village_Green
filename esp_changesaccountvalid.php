<?php

$mailUser = $_SESSION['mail'];

if (isset($_POST['buttonMdfAdresse'])) { 
    require_once 'config/connectDB.php';
    $adresseReg = '/^(?:([0-9]{0,4}[A-Z]{0,2})([,\s]?))(?:((bis|ter|qua)[\s,-])?)([A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'"\-\s]{0,50}[\s]*)([0-9]{0,5})$/';
    $formError = array();
    $MdfclientAdresse = htmlspecialchars($_POST['MdfclientAdresse']);

    $selectUser = $db->prepare('SELECT * FROM `clients` WHERE client_mail = ? ');
    $selectUser->execute(array($mailUser));
    while ($ligne = $selectUser->fetch()) {
        $selectAdresse = $ligne['client_adresse'];
    }

    if (!empty($_POST['MdfclientAdresse'])) {
        if ($_POST['MdfclientAdresse'] != $selectAdresse) {
            if (!preg_match($adresseReg, $MdfclientAdresse)) {
                $formError['MdfclientAdresse'] = 'Votre adresse ne convient pas aux normes !';
            }
        } else {
            $formError['MdfclientAdresse'] = 'Même donnée que précedemment !';
        }
    } else {
        $formError['MdfclientAdresse'] = 'Veuillez rentrer une adresse !';
    }

    if (empty($formError)) {
        $requete = $db->prepare('UPDATE clients SET client_adresse = ? WHERE client_mail = ?');
        $requete->execute(array($MdfclientAdresse, $mailUser));
        $formError['MdfclientAdresse'] = 'Vos données ont été changées !';
    }
}


if (isset($_POST['buttonMdfVille'])) { 
    require_once 'config/connectDB.php';
    $villeReg = '/^[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'"-\/\s]{1,40}$/';
    $formError = array();
    $MdfclientVille = htmlspecialchars($_POST['MdfclientVille']);

    $selectUserByMail1 = $db->prepare('SELECT * FROM `clients` WHERE client_mail = ? ');
    $selectUserByMail1->execute(array($mailUser));
    while ($ligne = $selectUserByMail1->fetch()) {
        $selectVille = $ligne['client_ville'];
    }

    if (!empty($_POST['MdfclientVille'])) {
        if ($_POST['MdfclientVille'] != $selectVille) {
            if (!preg_match($villeReg, $MdfclientVille)) {
                $formError['MdfclientVille'] = 'Votre ville ne convient pas aux normes !';
            }
        } else {
            $formError['MdfclientVille'] = 'Même donnée que précedemment !';
        }
    } else {
        $formError['MdfclientVille'] = 'Veuillez rentrer une ville !';
    }


    if (empty($formError)) {
        $requete = $db->prepare('UPDATE clients SET client_ville = ? WHERE client_mail = ?');
        $requete->execute(array($MdfclientVille, $mailUser));
        $formError['MdfclientVille'] = 'Vos données ont été changées !';
    }
}


if (isset($_POST['buttonMdfCodeP'])) { 
    require_once 'config/connectDB.php';
    $codepReg = '/^((0[1-9])|([1-8][0-9])|(9[0-8])|(2A)|(2B)) *([0-9]{3})?$/';
    $formError = array();
    $MdfclientCodeP = htmlspecialchars($_POST['MdfclientCodeP']);

    $selectUserByMail2 = $db->prepare('SELECT * FROM `clients` WHERE client_mail = ? ');
    $selectUserByMail2->execute(array($mailUser));
    while ($ligne = $selectUserByMail2->fetch()) {
        $selectCodeP = $ligne['client_codepo'];
    }

    if (!empty($_POST['MdfclientCodeP'])) {
        if ($_POST['MdfclientCodeP'] != $selectCodeP) {
            if (!preg_match($codepReg, $MdfclientCodeP)) {
                $formError['MdfclientCodeP'] = 'Votre code postal ne convient pas aux normes !';
            }
        } else {
            $formError['MdfclientCodeP'] = 'Même donnée que précedemment !';
        }
    } else {
        $formError['MdfclientCodeP'] = 'Veuillez rentrer un code postal !';
    }

    if (empty($formError)) {
        $requete = $db->prepare('UPDATE clients SET client_codepo = ? WHERE client_mail = ?');
        $requete->execute(array($MdfclientCodeP, $mailUser));
        $formError['MdfclientCodeP'] = 'Vos données ont été changées !';
    }
}


if (isset($_POST['buttonMdfTel'])) {
    require_once 'config/connectDB.php';
    $telReg = '/^([\d]{2})([\s.]?)([\d]{2})([\s.]?)([\d]{2})([\s.]?)([\d]{2})([\s.]?)([\d]{2})([\s.]?)$/';
    $formError = array();
    $MdfclientTel = htmlspecialchars($_POST['MdfclientTel']);

    $selectUser = $db->prepare('SELECT * FROM `clients` WHERE client_mail = ? ');
    $selectUser->execute(array($mailUser));
    while ($ligne = $selectUser->fetch()) {
        $selectTel = $ligne['client_telephone'];
    }

    if (!empty($_POST['MdfclientTel'])) {
        if ($_POST['MdfclientTel'] != $selectTel) {
            if (!preg_match($telReg, $MdfclientTel)) {
                $formError['MdfclientTel'] = 'Votre téléphone ne convient pas aux normes !';
            }
        } else {
            $formError['MdfclientTel'] = 'Même donnée que précedemment !';
        }
    } else {
        $formError['MdfclientTel'] = 'Veuillez rentrer un n° de téléphone !';
    }

    if (empty($formError)) {
        $requete = $db->prepare('UPDATE clients SET client_telephone = ? WHERE client_mail = ?');
        $requete->execute(array($MdfclientTel, $mailUser));
        $formError['MdfclientTel'] = 'Vos données ont été changées !';
    }
}