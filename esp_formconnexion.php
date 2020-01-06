<?php
include 'esp_validconnexion.php';
include 'Ext_head.php';
?>

<div class="container">
    <div class="row justify-content-center overlay-decalage-connexion overlay">
        <div class="encadre-milieu">
            <a href="Accueil.php" class="Logo-Accueil logo-decalage">
                <section class="logo"><span class="orangetexte">V</span>illage <span class="orangetexte">G</span>reen
                </section>
            </a>
            <div class="encadre-connexion">
                <div class="col centrage-col">
                    <p>
                        <h2 class="text-center legend">Connexion</h2><br>
                        <form action="" name="formConclient" method="post">

                            <label for="ConclientMail">Email :</label><input class="form-control connexion-champ" type="email" name="ConclientMail" id="ConclientMail" placeholder=" john.doe@gmail.com" required>
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

                            <label for="ConclientPass">Mot de passe :</label><input class="form-control connexion-champ" type="password" name="ConclientPass" id="ConclientPass" required>
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

                            <div class="row centrage-bouton">
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
            <div class="col centrage-col">
                <p class="centrage">Nouveau client? <a href="esp_forminscription.php"> Commencer ici.</a></p>
            </div>
        </div>
    </div>
</div>

<?php
include 'Ext_script.php';
?>
<script src=""></script>