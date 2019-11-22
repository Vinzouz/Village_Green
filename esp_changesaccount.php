<?php
session_start();
include 'esp_changesaccountvalid.php';
include 'Ext_head.php';


$adresseReg = '/^(?:([0-9]{0,4}[A-Z]{0,2})([,\s]?))(?:((bis|ter|qua)[\s,-])?)([A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'"\-\s]{0,50}[\s]*)([0-9]{0,5})$/';
$villeReg = '/^[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ\'"-\/\s]{1,40}$/';
$codepReg = '/^((0[1-9])|([1-8][0-9])|(9[0-8])|(2A)|(2B)) *([0-9]{3})?$/';
$telReg = '/^([\d]{2})([\s.]?)([\d]{2})([\s.]?)([\d]{2})([\s.]?)([\d]{2})([\s.]?)([\d]{2})([\s.]?)$/';
?>

<div class="container">
    <?php if ((isset($_SESSION['mail'])) && (isset($_SESSION['grade']))) {

        require_once 'config/connectDB.php';
        $requete = $db->prepare('SELECT * FROM `clients` WHERE client_mail = ? ');
        $requete->execute(array($_SESSION['mail']));
        while ($ligne = $requete->fetch()) {
            $IDUser = $ligne['client_id'];
            $AdresseUser = $ligne['client_adresse'];
            $VilleUser = $ligne['client_ville'];
            $CodePUser = $ligne['client_codepo'];
            $TelUser = $ligne['client_telephone'];
        } ?>

        <div class="row justify-content-center">
            <div class="col-4">
                <h4 class="text-center">Paramètres du compte</h4>
                <form action="" name="formModif" method="post">

                    <label for="MdfclientAdresse">Votre adresse :</label><input class="form-control" type="text" name="MdfclientAdresse" id="MdfclientAdresse" value="<?= $AdresseUser ?>">
                    <span id="missMdfclientAdresse"></span>
                    <?php
                        if (isset($formError['MdfclientAdresse'])) {
                            ?>
                        <span class="alert alert-danger" role="alert" style="top:12px">
                            <?= $formError['MdfclientAdresse'] ?>
                        </span>
                    <?php
                        }
                        ?><br>
                            <input class="form-control" type="submit" name="buttonMdfAdresse" id="buttonMdfAdresse" value="Modifier">


                    <label for="MdfclientVille">Votre ville :</label><input class="form-control" type="text" name="MdfclientVille" id="MdfclientVille" value="<?= $VilleUser ?>">
                    <span id="missMdfclientVille"></span>
                    <?php
                        if (isset($formError['MdfclientVille'])) {
                            ?>
                        <span class="alert alert-danger" role="alert" style="top:12px">
                            <?= $formError['MdfclientVille'] ?>
                        </span>
                    <?php
                        }
                        ?><br>
                            <input class="form-control" type="submit" name="buttonMdfVille" id="buttonMdfVille" value="Modifier">


                    <label for="MdfclientCodeP">Votre code postal :</label><input class="form-control" type="text" name="MdfclientCodeP" id="MdfclientCodeP" value="<?= $CodePUser ?>">
                    <span id="missMdfclientCodeP"></span>
                    <?php
                        if (isset($formError['MdfclientCodeP'])) {
                            ?>
                        <span class="alert alert-danger" role="alert" style="top:12px">
                            <?= $formError['MdfclientCodeP'] ?>
                        </span>
                    <?php
                        }
                        ?><br>
                            <input class="form-control" type="submit" name="buttonMdfCodeP" id="buttonMdfCodeP" value="Modifier">


                    <label for="MdfclientTel">Votre téléphone :</label><input class="form-control" type="tel" name="MdfclientTel" id="MdfclientTel" value="<?= $TelUser ?>">
                    <span id="missMdfclientTel"></span>
                    <?php
                        if (isset($formError['MdfclientTel'])) {
                            ?>
                        <span class="alert alert-danger" role="alert" style="top:12px">
                            <?= $formError['MdfclientTel'] ?>
                        </span>
                    <?php
                        }
                        ?><br>

                            <input class="form-control" type="submit" name="buttonMdfTel" id="buttonMdfTel" value="Modifier">


                </form>
            <?php } ?>
            </div>

        </div>

</div>

<?php

?>