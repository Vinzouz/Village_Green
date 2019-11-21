<?php


$mailReg = '/([a-zA-Z0-9-_]{1,20})+(\.[a-zA-Z0-9-_]{1,20})*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]{1,20})*\.[a-zA-Z]{2,4}/';
$passwordReg = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/';

if (isset($_POST['buttonCon'])) {

$formError = array();

$ConclientMail = $_POST['ConclientMail'];
$ConclientPass = password_hash($_POST['ConclientPass'], PASSWORD_DEFAULT);

require_once 'config/connectDB.php';

// vérification des champs de saisies

// VERIF PSEUDO CONNEXION

if (empty($_POST['ConclientMail']) || !preg_match($mailReg, $_POST['ConclientMail'])) {
    $formError['ConclientMail'] = 'Votre mail est invalide !';
} else {
    $getUsersByMail = $db->prepare('SELECT * FROM clients WHERE client_mail = ?');
    $getUsersByMail->execute(array($ConclientMail));
    if (empty($getUsersByMail->fetch())) {
        $formError['ConclientMail'] = 'Aucun compte lié à ce mail !';
    }
}
// VERIF MDP CONNEXION

if (empty($_POST['ConclientPass']) || !preg_match($passwordReg, $_POST['ConclientPass'])) {
    $formError['ConclientPass'] = 'Votre mot de passe est invalide !';
}

if (empty($formError)) {

    $setMdp = $db->prepare('SELECT client_password FROM clients WHERE client_mail = ?');
    $setMdp->execute(array($ConclientMail));
    if (($mdpbdd = $setMdp->fetch(PDO::FETCH_OBJ)) && password_verify($_POST['ConclientPass'], $mdpbdd->client_password)) {
        session_start();
        $_SESSION["mail"] = $ConclientMail;
        $_SESSION["grade"] = "client";
        header ('Location:Accueil.php');
        
    } else {
        $formError['ConclientPass'] = 'Le mot de passe est incorrect !';
    }
} else {
    $formError['ConclientPass'] = 'Le mot de passe ne correspond pas !';
}
}

if (isset($_POST['buttonLostPass'])) {

    $formError = array();

    if (empty($formError)) {
        if (preg_match($mailReg, $_POST['mailLostPass']) && !empty($_POST['mailLostPass'])) {

            require_once 'config/connectDB.php';

            $mailLostPass = $_POST['mailLostPass'];
            $selectUser = $db->prepare('SELECT * FROM `clients` WHERE client_mail = ?');
            $selectUser->execute(array($mailLostPass));

            if ($selectUser->fetch()) {
                $requete = $db->prepare('SELECT * FROM `clients` WHERE client_mail = ?');
                $requete->execute(array($mailLostPass));

                while ($ligne = $requete->fetch()) {
                    $selectMail = $ligne["client_mail"];
                    $selectID = $ligne["client_id"];
                }
                $formError['mailLostPass'] = 'Un mail vous a été envoyé.';
                $sujet = 'Réinitialisation du mot de passe';
                $message = 'Bonjour ' . $mailLostPass . ', une réinitialisation du mot de passe a été lancée.
Si vous en êtes à l\'origine, cliquez sur ce lien : http://127.0.0.1/Village_Green/Village_Green/esp_lostpass.php?LPW=1&ID=' . $selectID . ' 
Si vous n\'en n\'êtes pas à l\'origine, cliquez sur ce lien : http://127.0.0.1/Village_Green/Village_Green/esp_lostpass.php?LPW=2';

                mail($selectMail, $sujet, $message);
            } else {
                $formError['mailLostPass'] = 'Aucun compte lié à ce mail !';
            }
        } else {
            $formError['mailLostPass'] = 'Mail invalide';
        }
    } else {
        $formError['mailLostPass'] = 'Erreur pendant l\'envoie';
    }
}


if (isset($_POST['buttonNewPass'])) {

    $formError = array();
    require_once 'config/connectDB.php';
    $newpassword = password_hash($_POST['mailNewPass'], PASSWORD_DEFAULT);
    $newpasswordvalid = password_hash($_POST['mailNewPassValid'], PASSWORD_DEFAULT);
    $IDhidden = $_GET['ID'];

    $selectUser = $db->prepare('SELECT * FROM `clients` WHERE client_id = ? ');
    $selectUser->execute(array($IDhidden));
    if ($selectUser->fetch()) {
        if (!empty($_POST['mailNewPass']) && !empty($_POST['mailNewPassValid'])) {
            if (preg_match($passwordReg, $_POST['mailNewPass']) && preg_match($passwordReg, $_POST['mailNewPassValid'])) {
                if ($_POST['mailNewPass'] == $_POST['mailNewPassValid']) {
                    if (empty($formError)) {
                        $requete = $db->prepare('UPDATE clients SET client_password = ? WHERE client_id = ?');
                        $requete->execute(array($newpassword, $IDhidden));
                        $formError['mailNewPassValid'] = 'Votre mot de passe a été changée !';
                    }
                } else {
                    $formError['mailNewPassValid'] = 'Votre mot de passe n\'est pas semblable au premier !';
                }
            } else {
                $formError['mailNewPassValid'] = 'Votre mot de passe ne convient pas aux normes !';
            }
        } else {
            $formError['mailNewPassValid'] = 'Votre mot de passe est invalide !';
        }
    }
}
