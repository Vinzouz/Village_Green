<?php 
// Vue formnewpass qui gère l'affichage du formulaire de réinitialisation de mot de passe client
?>
<div class="container">
    <div class="row justify-content-center overlay-decalage-connexion overlay">
        <div class="encadre-milieu">
            <a href="<?= site_url('') ?>" class="Logo-Accueil logo-decalage">
                <section class="logo"><span class="orangetexte">V</span>illage <span class="orangetexte">G</span>reen
                </section>
            </a>
            <div class="encadre-nouveaumdp">
                <div class="col centrage-col">
                    <p>
                        <h2 class="text-center legend">Réinitialisation du mot de passe</h2><br>
                        <?php
                        $attributes = array( // Affectation des attributs de formulaire
                            'method' => 'post',
                            'name' => 'formNewpass'
                        );
                        ?>
                        <p class="text-center">Veuillez rentrer un nouveau mot de passe</p>
                        <?php if ($this->session->flashdata('errors')) : // Si erreur du formulaire ?>
                            <?php echo $test = $this->session->flashdata('errors'); // Affichage des erreurs ?>
                        <?php endif; ?>
                      
                        <?= form_open("lostpass/updatepass", $attributes) // Appel de la fonction updatepass du controller lostpass grâce à l'envoi du formulaire ?>

                        <input class="form-control" hidden type="password" name="client_id">

                        <label for="mailNewPass">Nouveau mot de passe :</label><input class="form-control" type="password" name="client_newpass" >
                        <br>
                        <?php
                        if (isset($formError['mailNewPass'])) {
                        ?>
                            <span class="alert alert-danger" role="alert">
                                <?= $formError['mailNewPass'] ?>
                            </span>
                        <?php } ?>
                        <label for="mailNewPassValid">Confirmation du nouveau mot de passe :</label><input class="form-control" type="password" name="client_validnewpass" id="mailNewPassValid">
                        <br>
                        <?php
                        if (isset($formError['mailNewPassValid'])) {
                        ?>
                            <span class="alert alert-danger" role="alert">
                                <?= $formError['mailNewPassValid'] ?>
                            </span>
                        <?php } ?>

                        <div class="row centrage-bouton">
                            <div class="input-field col-6">
                                <input class="form-control" type="submit" name="buttonCon" id="buttonCon" value="Envoyer">
                            </div>
                        </div>
                        <?= form_close() ?>
                        <br>
                </div>
            </div>
        </div>
    </div>
</div>