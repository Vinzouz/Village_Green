<div class="container">


    <?php if (isset($_SESSION["panier"])) {
        $Panier = $_SESSION["panier"]; // Permet au foreach d'être initialisé
        $prixtotfinal = 0; // Initialisation de la variable hors du tableau pour éviter une boucle de reset et pouvoir afficher 0 en cas de panier vide. 
    }
    ?>

    <p>
        <h2 class="row justify-content-center titrepanier">Etape de validation :</h2>
    </p>
    <div class="row justify-content-center" id="lignetabpanier">
        <div class="table-responsive" id="tabpaniersecond">
            <table class="table table-striped table-hover table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Produit</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Prix total</th>
                    </tr>
                </thead>
                <tbody name="sub-panier" id="sub-panier">

                    <?php

                    foreach ($Panier as $key) {
                        $prixtot = $key[0]['produit_prix_HT'] * $key[1];  // Catch le prix x la quantité de chaque produit (pour le total par produit)
                        $prixtotfinal = $prixtotfinal + $prixtot; // calcul le prix final pour le total plus bas
                    ?>

                        <!-- Formulaire très important, qui permet d'envoyer vers le controler à chaque fois que le bouton supprimer apparait (a chaque fois qu'une ligne du panier est créée donc...) -->

                        <tr>
                            <td><?= $key[0]["produit_nom"] ?></td>
                            <td><?= $key[0]['produit_prix_HT'] ?><sup>€</sup></td>
                            <td><?= $key[1] ?></td>
                            <td><?= $prixtot ?><sup>€</sup></td>
                        </tr>
                    <?php

                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
    $tva = 0.2;
    $totaltva = $prixtotfinal * $tva;
    if ($prixtotfinal > 19) {
        $fraislivraison = 0;
        $fraislivraisonaffiche = 'Gratuit';
    } else {
        $fraislivraison = 3.5;
        $fraislivraisonaffiche = '3.5<sup>€</sup>';
    }
    $prixtotalfinalcommande = $prixtotfinal + $totaltva + $fraislivraison; ?>
    <div class="row justify-content-center" id="lignetax">
        <div class="table-responsive" id="taxtabpanier">
            <table class="table table-striped table-hover table-bordered">
                <tbody name="taxsub-panier" id="taxsub-panier">
                    <tr>
                        <td id="fraispanier">TVA (20%)</td>
                        <td><?= $totaltva ?><sup>€</sup></td>
                    </tr>
                    <tr>
                        <td id="fraispanier">Frais de livraison</td>
                        <td><?= $fraislivraisonaffiche ?></td>
                    </tr>
                    <tr>
                        <td id="fraispanier">Prix total (TVA + frais)</td>
                        <td><?= $prixtotalfinalcommande ?><sup>€</sup></td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>

    <h2 class="row justify-content-center titretotalapayer">Total à payer : <?= $prixtotalfinalcommande ?>€</h2>
    <?php
    $attributes = array(
        'method' => 'post',
        'name' => 'formCommande',
        'id' => 'formCommande'
    ); ?>
    <?= form_open('panier/commander', $attributes); ?>
    <div class="row justify-content-center">
        <div class="card" id="infoslivraison">
            <div class=card-body>
                <h5 class="card-title" id="ligne1infoslivraison">Vos informations de facturation et de livraison :</h5>
                <?php foreach ($dataC as $infos) { ?>
                    <p class="card-text" id="ligne2infoslivraison">Votre adresse de facturation :<br>
                        <?= $infos->client_adresse ?><br>
                        <?= $infos->client_ville ?><br>
                        <?= $infos->client_codepo ?></p><br>
                <?php } ?>
                <p class="card-text" id="ligne3infoslivraison">Voulez-vous vous faire livrer à votre adresse de facturation ?</p>
                <p class="card-text"><select name="Choixlivraison" id="Choixlivraison" onchange="ChoixlivraisonCheck(this.value)" required>
                        <option value=""> </option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select></p>
                <span id="missChoixlivraison"></span>
                <?php
                if (isset($formError['Choixlivraison'])) {
                ?>
                    <span class="alert alert-danger" role="alert" style="top:12px">
                        <?= $formError['Choixlivraison'] ?>
                    </span>
                <?php
                }
                ?>
                <span id="hidechoixlivraison" style="display:none;">
                    <p class="card-text" id="ligne4infoslivraison"><label for="Adresselivraison">Adresse :</label><input type="text" class="form-control" name="Adresselivraison" id="Adresselivraison"></p>
                    <span id="missAdresselivraison"></span>
                    <?php
                    if (isset($formError['Adresselivraison'])) {
                    ?>
                        <span class="alert alert-danger" role="alert" style="top:12px">
                            <?= $formError['Adresselivraison'] ?>
                        </span>
                    <?php
                    }
                    ?>
                    <p class="card-text" id="ligne5infoslivraison"><label for="Villelivraison">Ville :</label><input type="text" class="form-control" name="Villelivraison" id="Villelivraison"></p>
                    <span id="missVillelivraison"></span>
                    <?php
                    if (isset($formError['Villelivraison'])) {
                    ?>
                        <span class="alert alert-danger" role="alert" style="top:12px">
                            <?= $formError['Villelivraison'] ?>
                        </span>
                    <?php
                    }
                    ?>
                    <p class="card-text" id="ligne6infoslivraison"><label for="Codepolivraison">Code postal :</label><input type="text" class="form-control" name="Codepolivraison" id="Codepolivraison"></p>
                    <span id="missCodepolivraison"></span>
                    <?php
                    if (isset($formError['Codepolivraison'])) {
                    ?>
                        <span class="alert alert-danger" role="alert" style="top:12px">
                            <?= $formError['Codepolivraison'] ?>
                        </span>
                    <?php
                    }
                    ?>
                </span>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <?php $userid = $_SESSION['user_id'];
        if ($userid === 101 || 102 || 103) { ?>
            <input class="btn btn-success" type="button" name="buttonComm" id="buttonComm" value="Commander">
        <?php } ?>

        <input hidden type="text" class="form-control" name="Prixtotcommande" id="Prixtotcommande" value="<?= $prixtotalfinalcommande ?>">
        <?= form_close(); ?>
    </div>
</div>

<script src=<?= base_url('assets/js/esp_formcommande.js') ?>></script>