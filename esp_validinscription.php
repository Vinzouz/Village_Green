<?php

$nomReg = '/^([A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]{1,15})[-\'\s]{0,1}([A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]{1,15})[-\s]{0,1}([A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]{1,15})$/';
$adresseReg = '/^(?:([0-9]{0,4}[A-Z]{0,2})([,\s]?))(?:((bis|ter|qua)[\s,-])?)([A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'"\-\s]{0,50}[\s]*)([0-9]{0,5})$/';
$villeReg = '/^[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'"-\/\s]{1,40}$/';
$codepReg = '/^((0[1-9])|([1-8][0-9])|(9[0-8])|(2A)|(2B)) *([0-9]{3})?$/';
$telReg = '/^([\d]{2})([\s.]?)([\d]{2})([\s.]?)([\d]{2})([\s.]?)([\d]{2})([\s.]?)([\d]{2})([\s.]?)$/';
$mailReg = '/([a-zA-Z0-9-_]{1,20})+(\.[a-zA-Z0-9-_]{1,20})*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]{1,20})*\.[a-zA-Z]{2,4}/';
$siretReg = '/^[\d]{1,14}$/';
$passwordReg = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/';
$totalchamp = 12;

if (isset($_POST['buttonIns']) && count($_POST) === $totalchamp) {

    $formError = array();

    $InsclientNom = htmlspecialchars($_POST['InsclientNom']);
    $InsclientPrenom = htmlspecialchars($_POST['InsclientPrenom']);
    $InsclientAdresse = ($_POST['InsclientAdresse']);
    $InsclientVille = htmlspecialchars($_POST['InsclientVille']);
    $InsclientCodeP = htmlspecialchars($_POST['InsclientCodeP']);
    $InsclientTel = htmlspecialchars($_POST['InsclientTel']);
    $InsclientMail = $_POST['InsclientMail'];
    $InsclientType = htmlspecialchars($_POST['InsclientType']);
    $InsclientSiret = htmlspecialchars($_POST['InsclientSiret']);

    $InsclientPass = password_hash($_POST['InsclientPass'], PASSWORD_DEFAULT);
    $InsclientPassV = password_hash($_POST['InsclientPassV'], PASSWORD_DEFAULT);

    require_once 'config/connectDB.php';
    // vérification des champs de saisies

    // VERIF NOM INSCRIPTION

    if (!empty($_POST['InsclientNom']) or preg_match($nomReg, $_POST['InsclientNom'])) { } else {
        $formError['InsclientNom'] = 'Votre nom est invalide !';
    }

    // VERIF PRENOM INSCRIPTION

    if (!empty($_POST['InsclientPrenom']) or preg_match($nomReg, $_POST['InsclientPrenom'])) { } else {
        $formError['InsclientPrenom'] = 'Votre prénom est invalide !';
    }

    // VERIF ADRESSE INSCRIPTION

    if (!empty($_POST['InsclientAdresse']) && preg_match($adresseReg, $_POST['InsclientAdresse'])) { } else {
        $formError['InsclientAdresse'] = 'Votre adresse est invalide !';
    }

    // VERIF VILLE INSCRIPTION

    if (!empty($_POST['InsclientVille']) or preg_match($villeReg, $_POST['InsclientVille'])) { } else {
        $formError['InsclientVille'] = 'Votre ville est invalide !';
    }

    // VERIF CODE POSTAL INSCRIPTION

    if (!empty($_POST['InsclientCodeP']) or preg_match($codepReg, $_POST['InsclientCodeP'])) { } else {
        $formError['InsclientCodeP'] = 'Votre code postal est invalide !';
    }

    // VERIF TELEPHONE INSCRIPTION

    if (!empty($_POST['InsclientTel']) or preg_match($telReg, $_POST['InsclientTel'])) { } else {
        $formError['InsclientTel'] = 'Votre numéro de téléphone est invalide !';
    }

    // VERIF EMAIL INSCRIPTION

    if (!empty($_POST['InsclientMail']) or preg_match($mailReg, $_POST['InsclientMail'])) {
        $selectMail = $db->prepare('SELECT * FROM `clients` WHERE client_mail = ?');
        $selectMail->execute(array($InsclientMail));
        if ($selectMail->fetch()) {
            $formError['InsclientMail'] = 'Compte déjà existant pour cette adresse e-mail !';
        }
    } else {
        $formError['InsclientMail'] = 'Votre email est invalide !';
    }

    // VERIF TYPE INSCRIPTION

    if (!empty($_POST['InsclientType'])) {

        if (empty($_POST['InsclientSiret']) || !preg_match($siretReg, $_POST['InsclientSiret']) || $_POST['InsclientType'] === 'PAR') {
            $InsclientSiret = "0";
        } else if  ($_POST['InsclientType'] === 'PRO'){ }
        else {
            $formError['InsclientSiret'] = 'Votre n° de SIRET est invalide !';
        }

    } else {
        $formError['InsclientType'] = 'Spécifiez votre type !';
    }

    // VERIF SIRET INSCRIPTION


    // VERIF MDP INSCRIPTION

    if (empty($_POST['InsclientPass']) or empty($_POST['InsclientPassV']) or !preg_match($passwordReg, $_POST['InsclientPass']) or !preg_match($passwordReg, $_POST['InsclientPassV']) or $_POST['InsclientPass'] != $_POST['InsclientPassV']) {
        $formError['InsclientPass'] = 'Votre mot de passe est invalide !';
        $formError['InsclientPassV'] = 'Votre mot de passe est invalide !';
    }

    // SI TABLEAU D'ERREURS VIDE

    if (empty($formError)) {
        $setUser = $db->prepare('INSERT INTO clients SET client_nom = ?, client_prenom = ?, client_adresse = ?, client_ville = ?, client_codepo = ?, client_telephone = ?, client_mail = ?, client_type = ?, client_siret = ?, client_password = ?');
        $setUser->execute(array($InsclientNom, $InsclientPrenom, $InsclientAdresse, $InsclientVille, $InsclientCodeP, $InsclientTel, $InsclientMail, $InsclientType, $InsclientSiret, $InsclientPass));
        $_SESSION["mail"] = $InsclientMail;
        $_SESSION["role"] = "client";
        mail($InsclientMail, 'Inscription Village Green', 'Bonjour ' . $InsclientNom . '' . $InsclientPrenom . ', votre inscription au site Village Green a bien été effectuée !
    Vous pouvez dès à présent vous connecter.');
    header ('Location:Accueil.php');
    exit();
    }
}
