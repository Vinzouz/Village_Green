<?php
include 'Ext_head.php';
include 'Ext_header.php'; ?>



<div class="container">
    <div class="row justify-content-center">

        <div class="col-6">
            <p>
                <h2 class="text-center">Inscription</h2><br>
                <form action="" name="formInsclient" method="post">
                    <label for="InsclientNom">Votre nom :</label><input class="form-control" type="text" name="InsclientNom" id="InsclientNom">
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
                    <label for="InsclientPrenom">Votre prénom :</label><input class="form-control" type="text" name="InsclientPrenom" id="InsclientPrenom">
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
                    <label for="InslientRue">Votre rue :</label><input class="form-control" type="text" name="InsclientRue" id="InsclientRue">
                    <span id="missInsclientRue"></span>
                    <?php
                    if (isset($formError['InsclientRue'])) {
                        ?>
                        <span class="alert alert-danger" role="alert" style="top:12px">
                            <?= $formError['InsclientRue'] ?>
                        </span>
                    <?php
                    }
                    ?><br>
                    <label for="InsclientVille">Votre ville :</label><input class="form-control" type="text" name="InsclientVille" id="InsclientVille">
                    <span id="missInsclientVille"></span>
                    <?php
                    if (isset($formError['InsclientVille'])) {
                        ?>
                        <span class="alert alert-danger" role="alert" style="top:12px">
                            <?= $formError['InsclientVille'] ?>
                        </span>
                    <?php
                    }
                    ?><br>

                    <label for="InsclientCodeP">Votre code postal :</label><input class="form-control" type="text" name="InsclientCodeP" id="InsclientCodeP">
                    <span id="missInsclientCodeP"></span>
                    <?php
                    if (isset($formError['InsclientCodeP'])) {
                        ?>
                        <span class="alert alert-danger" role="alert" style="top:12px">
                            <?= $formError['InsclientCodeP'] ?>
                        </span>
                    <?php
                    }
                    ?><br>

                    <label for="InsclientTel">Votre téléphone :</label><input class="form-control" type="tel" name="InsclientTel" id="InsclientTel">
                    <span id="missInsclientTel"></span>
                    <?php
                    if (isset($formError['InsclientTel'])) {
                        ?>
                        <span class="alert alert-danger" role="alert" style="top:12px">
                            <?= $formError['InsclientTel'] ?>
                        </span>
                    <?php
                    }
                    ?><br>

                    <label for="InsclientMail">Votre mail :</label><input class="form-control" type="email" name="InsclientMail" id="InsclientMail">
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

                    <label for="InsclientType">Vous êtes :</label><select size="1" name="InsclientType" id="InsclientType" onchange="giveSelect2(this.value)">
                        <option value="">Choisissez votre type</option>
                        <option value="PAR">Particulier</option>
                        <option value="PRO">Professionnel</option>
                    </select>
                    <span id="missInsclientType"></span>
                    <?php
                    if (isset($formError['InsclientType'])) {
                        ?>
                        <span class="alert alert-danger" role="alert" style="top:12px">
                            <?= $formError['InsclientType'] ?>
                        </span>
                    <?php
                    }
                    ?><br><br>

                    <span id="hideInsclientSiret" style=""><label for="InsclientSiret">Votre SIRET :</label><input class="form-control" type="text" name="InsclientSiret" id="InsclientSiret"></span>
                    <span id="missInsclientSiret"></span>
                    <?php
                    if (isset($formError['InsclientSiret'])) {
                        ?>
                        <span class="alert alert-danger" role="alert" style="top:12px">
                            <?= $formError['InsclientSiret'] ?>
                        </span>
                    <?php
                    }
                    ?><br>

                    <div class="row">
                        <div class="col-6">
                            <label for="InsclientPass">Votre mot de passe :</label><input class="form-control" type="password" name="InsclientPass" id="InsclientPass">
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
                        <div class="col-6">
                            <label for="InsclientPassV">Valdiation du mot de passe :</label><input class="form-control" type="password" name="InsclientPassV" id="InsclientPassV">
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
                            <input class="form-control" type="submit" name="buttonIns" id="buttonIns" value="S'inscrire">
                        </div>
                        <div class="input-field col-6">
                            <input class="form-control" type="reset" value="Annuler">
                        </div>
                    </div>
                </form>
                <br>

        </div>
    </div>

    <?php
    include 'Ext_footer.php';
    include 'Ext_script.php';
    include 'Script.js'
    ?>