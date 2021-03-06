<?php 
// Vue formconnexion qui gère l'affichage du formulaire de connexion client
?>
<div class="container">
    <div class="row justify-content-center overlay-decalage-connexion overlay">
        <div class="encadre-milieu">
            <a href="<?= site_url('home/index') ?>" class="Logo-Accueil logo-decalage">
                <section class="logo"><span class="orangetexte">V</span>illage <span class="orangetexte">G</span>reen
                </section>
            </a>
            <div class="encadre-connexion">
                <div class="col centrage-col">
                    <p>
                        <h2 class="text-center legend">Connexion</h2><br>
                        <?php
                        $attributes = array( // Affectation des attributs de formulaire
                            'method' => 'post',
                            'name' => 'formConclient'
                        );
                    ?>
                    <div name="errormdp"></div>
                    <?php if ( $this->session->flashdata( 'errors' ) ): // Si erreur du formulaire ?>
                        <?php  echo $test = $this->session->flashdata( 'errors' ); // Affichage des erreurs ?>
                    <?php endif; ?>
                    <?= form_open( 'connexion/login', $attributes ) // Appel de la fonction login du controller connexion grâce à l'envoi du formulaire ?>

                            <label for="ConclientMail">Email :</label><input class="form-control connexion-champ" type="email" name="client_mail" id="ConclientMail" placeholder=" john.doe@gmail.com" required>
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

                            <label for="ConclientPass">Mot de passe :</label><input class="form-control connexion-champ" type="password" name="client_password" id="ConclientPass" required>
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
                            <?= form_close() ?>
                        <br>
                </div>
            </div>
            <div class="col centrage-col">
                <p class="centrage">Nouveau client? <a href="<?= site_url('home/inscription') ?>"> Commencer ici.</a></p>
                <p class="centrage">Mot de passe perdu? <a href="<?= site_url('lostpass/index') ?>"> Cliquez ici.</a></p>
            </div>
        </div>
    </div>
</div>
