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

?>