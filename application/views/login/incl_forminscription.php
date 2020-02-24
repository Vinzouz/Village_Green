<div class="container">
    <div class="row justify-content-center overlay-decalage-inscription overlay">
        <div class="encadre-milieu2">
            <a href="<?= site_url('') ?>" class="Logo-Accueil logo-decalage">
                <section class="logo"><span class="orangetexte">V</span>illage <span class="orangetexte">G</span>reen
                </section>
            </a>
            <div class="encadre-inscription">
                <div class="col centrage-col2">
                    <h2 class="text-center legend">Inscription</h2><br>
                    <?php
                    $attributes = array(
                        'method' => 'post',
                        'name' => 'formInsclient'
                    );
                    ?>
                    <?php if ($this->session->flashdata('errors')) : ?>
                        <?php echo $test = $this->session->flashdata('errors'); ?>
                    <?php endif; ?>
                    <?= form_open('register/store', $attributes) ?>

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="InsclientNom">Nom :</label><input class="form-control" type="text" name="InsclientNom" id="InsclientNom" placeholder="DOE" required>
                            <span id="missInsclientNom"></span>
                            <?php
                            if (isset($formError['InsclientNom'])) {
                            ?>
                                <span class="alert alert-danger" role="alert" style="top:12px">
                                    <?= $formError['InsclientNom'] ?>
                                </span>
                            <?php
                            }
                            ?><br>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="InsclientPrenom">Prénom :</label><input class="form-control" type="text" name="InsclientPrenom" id="InsclientPrenom" placeholder="John" required>
                            <span id="missInsclientPrenom"></span>
                            <?php
                            if (isset($formError['InsclientPrenom'])) {
                            ?>
                                <span class="alert alert-danger" role="alert" style="top:12px">
                                    <?= $formError['InsclientPrenom'] ?>
                                </span>
                            <?php
                            }
                            ?><br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label for="InsclientAdresse">Adresse :</label><input class="form-control" type="text" name="InsclientAdresse" id="InsclientAdresse" placeholder="25, rue Charles de Gaulle - Bâtiment E - Apt 106" required>
                            <span id="missInsclientAdresse"></span>
                            <?php
                            if (isset($formError['InsclientAdresse'])) {
                            ?>
                                <span class="alert alert-danger" role="alert" style="top:12px">
                                    <?= $formError['InsclientAdresse'] ?>
                                </span>
                            <?php
                            }
                            ?><br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="InsclientCodeP">Code Postal :</label><input class="form-control" type="text" name="InsclientCodeP" id="InsclientCodeP" placeholder="75000" required>
                            <span id="missInsclientCodeP"></span>
                            <?php
                            if (isset($formError['InsclientCodeP'])) {
                            ?>
                                <span class="alert alert-danger" role="alert" style="top:12px">
                                    <?= $formError['InsclientCodeP'] ?>
                                </span>
                            <?php
                            }
                            ?> <br>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="InsclientVille">Ville :</label><input class="form-control" type="text" name="InsclientVille" id="InsclientVille" placeholder="Paris" required>
                            <span id="missInsclientVille"></span>
                            <?php
                            if (isset($formError['InsclientVille'])) {
                            ?>
                                <span class="alert alert-danger" role="alert" style="top:12px">
                                    <?= $formError['InsclientVille'] ?>
                                </span>
                            <?php
                            }
                            ?>
                        </div>
                        <br>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="InsclientTel">Téléphone :</label><input class="form-control" type="tel" name="InsclientTel" id="InsclientTel" placeholder="07.12.34.56.78" required>
                            <span id="missInsclientTel"></span>
                            <?php
                            if (isset($formError['InsclientTel'])) {
                            ?>
                                <span class="alert alert-danger" role="alert" style="top:12px">
                                    <?= $formError['InsclientTel'] ?>
                                </span>
                            <?php
                            }
                            ?>
                        </div>
                        <br>

                        <div class="col-12 col-sm-6">
                            <label for="InsclientMail">Email :</label><input class="form-control" type="email" name="InsclientMail" id="InsclientMail" placeholder="john.doe@gmail.com" required>
                            <span id="missInsclientMail"></span>
                            <?php
                            if (isset($formError['InsclientMail'])) {
                            ?>
                                <span class="alert alert-danger" role="alert" style="top:12px">
                                    <?= $formError['InsclientMail'] ?>
                                </span>
                            <?php
                            }
                            ?><br>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-6">
                            <label for="InsclientType">Vous êtes :</label><br><select name="InsclientType" id="InsclientType" onchange="InsclientTypeCheck(this.value)" required>
                                <option value="0">Choisissez votre type</option>
                                <option value="PAR">un Particulier</option>
                                <option value="PRO">un Professionnel</option>
                            </select>
                            <span id="missInsclientType"></span>
                            <?php
                            if (isset($formError['InsclientType'])) {
                            ?>
                                <span class="alert alert-danger" role="alert">
                                    <?= $formError['InsclientType'] ?>
                                </span>
                            <?php
                            }
                            ?>
                            <div></div>
                        </div>
                        <div class="col-6">
                            <span id="hideInsclientSiret" style="display:none;"><label for="InsclientSiret">SIRET :</label><input class="form-control" type="text" name="InsclientSiret" id="InsclientSiret" placeholder="732 829 320 00074"></span>
                            <span id="missInsclientSiret"></span>
                            <?php
                            if (isset($formError['InsclientSiret'])) {
                            ?>
                                <span class="alert alert-danger" role="alert" style="top:12px">
                                    <?= $formError['InsclientSiret'] ?>
                                </span>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="InsclientPass">Mot de passe :</label><input class="form-control" type="password" name="InsclientPass" id="InsclientPass" required>
                            <span id="missInsclientPass"></span>
                            <?php
                            if (isset($formError['InsclientPass'])) {
                            ?>
                                <span class="alert alert-danger" role="alert" style="top:12px">
                                    <?= $formError['InsclientPass'] ?>
                                </span>
                            <?php
                            }
                            ?><br>
                        </div>


                        <div class="col-12 col-sm-6">
                            <label for="InsclientPassV">Validation du mot de passe :</label><input class="form-control" type="password" name="InsclientPassV" id="InsclientPassV" required>
                            <span id="missInsclientPassV"></span>
                            <?php
                            if (isset($formError['InsclientPassV'])) {
                            ?>
                                <span class="alert alert-danger" role="alert" style="top:12px">
                                    <?= $formError['InsclientPassV'] ?>
                                </span>
                            <?php
                            }
                            ?><br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col-6">
                            <input class="form-control" type="button" name="buttonIns" id="buttonIns" value="S'inscrire">
                        </div>
                        <div class="input-field col-6">
                            <input class="form-control" type="reset" value="Annuler">
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
            <div class="col centrage-col">
                <p class="centrage">Déjà client? <a href="<?= site_url('connexion/index') ?>"> C'est par
                        là.</a></p>
            </div>
        </div>
    </div>
</div>

<script src=<?= base_url('assets/js/esp_forminsvalid.js') ?>></script>