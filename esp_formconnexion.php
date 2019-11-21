<?php
include 'esp_validconnexion.php';
include 'Ext_head.php';
include 'Ext_header.php'; ?>

<div class="container">
    <div class="row justify-content-center">

        <div class="col-4">
            <p>
                <h2 class="text-center">Connexion</h2><br>
                <form action="" name="formConclient" method="post">

                    <label for="ConclientMail">Votre mail :</label><input class="form-control" type="email" name="ConclientMail" id="ConclientMail" placeholder="john.doe@gmail.com" required>
                    <span id="missConclientMail"></span>
                    <?php
                    if (isset($formError['ConclientMail'])) {
                        ?>
                        <span class="alert alert-danger" role="alert" style="top:12px">
                            <?= $formError['ConclientMail'] ?>
                        </span>
                    <?php
                    }
                    ?><br>

                    <label for="ConclientPass">Votre mot de passe :</label><input class="form-control" type="password" name="ConclientPass" id="ConclientPass" required>
                    <span id="missConclientPass"></span>
                    <?php
                    if (isset($formError['ConclientPass'])) {
                        ?>
                        <span class="alert alert-danger" role="alert" style="top:12px">
                            <?= $formError['ConclientPass'] ?>
                        </span>
                    <?php
                    }
                    ?><br>

                    <div class="row">
                        <div class="input-field col-6">
                            <input class="form-control" type="submit" name="buttonCon" id="buttonCon" value="Se connecter">
                        </div>
                        <div class="input-field col-6">
                            <input class="form-control" type="reset" value="Annuler">
                        </div>
                    </div>
                </form>
                <br>
        </div>
    </div>
</div>

<?php
include 'Ext_footer.php';
include 'Ext_script.php';
?>
<script src=""></script>