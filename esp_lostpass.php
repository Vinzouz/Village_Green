<?php
include 'esp_validconnexion.php';
include 'Ext_head.php';
include 'Ext_header.php';
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-6">
            <br>
            <h4 class="text-center">Réinitialisation du mot de passe</h4>
            <?php

            if (isset($_GET['LPW']) == 1 && isset($_GET['ID'])) {
                require_once 'config/connectDB.php';

                $ID = $_GET['ID']; ?>

                <form action="" name="formNewPass" method="post">

                    <label for="mailNewPass">Nouveau mot de passe :</label><input class="form-control" type="password" name="mailNewPass" id="mailNewPass">
                    <br>
                    <?php
                        if (isset($formError['mailNewPass'])) {
                            ?>
                        <span class="alert alert-danger" role="alert">
                            <?= $formError['mailNewPass'] ?>
                        </span>
                    <?php } ?>
                    <label for="mailNewPassValid">Confirmation nouveau mot de passe :</label><input class="form-control" type="password" name="mailNewPassValid" id="mailNewPassValid">
                    <br>
                    <?php
                        if (isset($formError['mailNewPassValid'])) {
                            ?>
                        <span class="alert alert-danger" role="alert">
                            <?= $formError['mailNewPassValid'] ?>
                        </span>
                    <?php } ?>

                    <p><input class="form-control" type="submit" name="buttonNewPass" id="buttonNewPass" value="Envoyer"></p>
        </div>
    </div>
    </form>
</div>
<?php
} else if (isset($_GET['LPW']) == 2) {
    ?>
    <p>La réinitialisation du mot de passe a été annulée.</p>
<?php } else { ?>
    <p class="text-center">Veuillez renseigner votre pseudo pour reçevoir un mail dans le but de réinitialiser votre mot de passe.</p>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <?php require_once 'config/connectDB.php'; ?>

                <form action="" name="formLostPass" method="post">

                    <label for="mailLostPass">Mail :</label><input class="form-control" type="text" name="mailLostPass" id="mailLostPass" placeholder="john.doe@gmail.com">
                    <br>

                    <span id="missMailLostPass"></span>
                    <?php
                        if (isset($formError['mailLostPass'])) {
                            ?>
                        <span class="alert alert-danger" role="alert">
                            <?= $formError['mailLostPass'] ?>
                        </span>
                    <?php } ?>
                    <p><input class="form-control" type="submit" name="buttonLostPass" id="buttonLostPass" value="Envoyer"></p>
            </div>

            </form>
        </div><br>
    </div>
<?php } ?>

</div>


<?php
include 'Ext_footer.php';
include 'Ext_script.php';
?>