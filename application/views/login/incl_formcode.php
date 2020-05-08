<?php 
// Vue formcode qui gère l'affichage du formulaire pour rentrer le code unique pour changement de mot de passe client
?>
<div class="container">
    <div class="row justify-content-center overlay-decalage-connexion overlay">
        <div class="encadre-milieu">
            <a href="<?= site_url('') ?>" class="Logo-Accueil logo-decalage">
                <section class="logo"><span class="orangetexte">V</span>illage <span class="orangetexte">G</span>reen
                </section>
            </a>
            <div class="encadre-connexion">
                <div class="col centrage-col">
                    <p>
                        <h2 class="text-center legend">Mot de passe perdu</h2><br>
                        <?php
                        $attributes = array( // Affectation des attributs de formulaire
                            'method' => 'post',
                            'name' => 'formCode'
                        );
                        ?>
                        <p class="text-center">Rentrez votre code unique.</p>
                        <?php if ($this->session->flashdata('errors')) : // Si erreur du formulaire ?>
                            <?php echo $test = $this->session->flashdata('errors'); // Affichage des erreurs ?>
                        <?php endif; ?>
                        <?= form_open('lostpass/verif', $attributes) // Appel de la fonction verif du controller lostpass grâce à l'envoi du formulaire ?>

                        <label for="mailLostPass">Code :</label><input class="form-control connexion-champ" type="text" name="client_temporaire_code" id="ConclientMail" required>
                        <span id="missmailLostPass"></span>
                        <?php
                        if (isset($formError['mailLostPass'])) {
                        ?>
                            <span class="alert alert-danger" role="alert" style="top:12px">
                                <?= $formError['mailLostPass'] ?>
                            </span>
                        <?php
                        }
                        ?><br>

                        <div class="row centrage-bouton">
                            <div class="input-field col-6">
                                <input class="form-control" type="submit" name="buttonCon" id="buttonCon" value="Envoyer">
                            </div>
                        </div>
                        <?= form_close() ?>
                        <br>
                </div>
            </div>
            <div class="col centrage-col">
                <p class="centrage"><a href="<?= site_url('connexion/index') ?>">Retourner à la connexion</a></p>
            </div>
        </div>
    </div>
</div>