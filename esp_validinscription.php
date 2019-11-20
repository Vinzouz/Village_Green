<?php

$nomReg = '/^([A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]{1,15})[-\'\s]{0,1}([A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]{1,15})[-\s]{0,1}([A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]{1,15})$/';
$adresseReg = '/^(?:([0-9]{0,4})([,\s]?))(?:((bis|ter|qua)[\s,-])?)([A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'"-\s]{0,50}[\s]*)([0-9]{0,5})$/';
$villeReg = '/^[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'"-\/\s]{1,40}$/';
$codepReg = '/^((0[1-9])|([1-8][0-9])|(9[0-8])|(2A)|(2B)) *([0-9]{3})?$/';
$telReg = '/^([\d]{2})([\s.]?)([\d]{2})([\s.]?)([\d]{2})([\s.]?)([\d]{2})([\s.]?)([\d]{2})([\s.]?)$/';
$mailReg = '/([a-zA-Z0-9-_]{1,20})+(\.[a-zA-Z0-9-_]{1,20})*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]{1,20})*\.[a-zA-Z]{2,4}/';
$siretReg = '/^[\d]{14}$/';
$passwordReg = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/';
$totalchamp = 12;

if (isset($_POST['buttonIns']) && count($_POST) === $totalchamp) {

    $formError = array();

    $InsclientNom = htmlspecialchars($_POST['InsclientNom']);
    $InsclientPrenom = htmlspecialchars($_POST['InsclientPrenom']);
    $InsclientAdresse = htmlspecialchars($_POST['InsclientAdresse']);
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

    if (!empty($_POST['InsclientPrenom']) or preg_match($prenomReg, $_POST['InsclientPrenom'])) { } else {
        $formError['InsclientPrenom'] = 'Votre prénom est invalide !';
    }

    // VERIF ADRESSE INSCRIPTION

    if (!empty($_POST['InsclientAdresse']) or preg_match($adresseReg, $_POST['InsclientAdresse'])) { } else {
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

    // VERIF EMAIL INSCRIPTION

    if (!empty($_POST['mailIns']) or preg_match($emailReg, $_POST['mailIns'])) {
        $selectMail = $dbAuth->prepare('SELECT * FROM `users` WHERE users_mail = ?');
        $selectMail->execute(array($mailIns));
        if ($selectMail->fetch()) {
            $formError['mailIns'] = 'Compte déjà existant pour cette adresse e-mail !';
        }
    } else {
        $formError['mailIns'] = 'Votre email est invalide !';
    }

    // VERIF TYPE INSCRIPTION

    if (!empty($_POST['InsclientType'])) { } else {
        $formError['InsclientType'] = 'Votre type est invalide !';
    }

    // VERIF SIRET INSCRIPTION

    if (!empty($_POST['InsclientSiret']) or preg_match($siretReg, $_POST['InsclientSiret'])) { } else {
        $formError['InsclientSiret'] = 'Votre adresse est invalide !';
    }

    // VERIF MDP INSCRIPTION

    if (empty($_POST['InsclientPass']) or empty($_POST['InsclientPassV']) or !preg_match($passwordReg, $_POST['InsclientPass']) or !preg_match($passwordReg, $_POST['InsclientPassV']) or $_POST['InsclientPass'] != $_POST['InsclientPassV']) {
        $formError['passwordIns'] = 'Votre mot de passe est invalide ou n\'est pas semblable au premier !';
    }

    // SI TABLEAU D'ERREURS VIDE

    if (empty($formError)) {
        $setUser = $db->prepare('INSERT INTO client SET client_nom = ?, client_prenom = ?, client_adresse = ?, client_ville = ?, client_codepo = ?, client_tel = ?, client_mail = ?, client_type = ?, client_type = ?, client_siret = ?, client_password = ?');
        $setUser->execute(array($InsclientNom, $InsclientPrenom, $InsclientAdresse, $InsclientVille, $InsclientCodeP, $InsclientTel, $InsclientMail, $InsclientType, $InsclientSiret, $InsclientPass));
        $_SESSION["login"] = $pseudoIns;
        $_SESSION["role"] = "client";
        mail($InsclientMail, 'Inscription Village Green', 'Bonjour ' . $InsclientNom .''. $InsclientPrenom . ', votre inscription au site Jarditou a bien été effectuée !
    Vous pouvez dès à présent vous connecter.');
    }
    // si présence de la valeur du bouton de validation connexion
}
