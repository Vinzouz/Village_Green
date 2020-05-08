<?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1) {
    if ($_SESSION["user_id"] == $dataCommande[0]->commande_client_id) // Permet de s'assurer que l'ID de l'utilisateur est bien celle du client de la commande, sinon le redirige
    { ?>

        <div class="container">

            <div class="row" style="margin: 10px 0px 10px 0px; padding: 15px 15px 15px 15px; border: 3px solid rgba(241, 137, 1, 0.932); border-radius: 30px; background-color: rgb(109, 109, 109, 0.5);">
                <div class="col-12">

                    <p>
                        <h2 class="row justify-content-center titrepanier">Details de la commande n°<?= $dataCommande[0]->commande_id ?> ( <?= $dataCommande[0]->commande_etat ?> ) :</h2> <? // Permet d'afficher le n° de la commande et son état 
                                                                                                                                                                                            ?>
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
                                    $prixtotfinal = 0;

                                    foreach ($dataCommande as $key) {
                                        $prixtot = $key->secomposede_qtite_commande * $key->secomposede_prix_vente;  // Catch le prix x la quantité de chaque produit (pour le total par produit)
                                        $prixtotfinal = $prixtotfinal + $prixtot; // calcul le prix final pour le total plus bas
                                    ?>
                                        <tr>
                                            <td><?= $key->produit_nom ?></td>
                                            <td><?= $key->secomposede_prix_vente ?><sup>€</sup></td>
                                            <td><?= $key->secomposede_qtite_commande ?></td>
                                            <td><?= $prixtot ?><sup>€</sup></td>
                                        </tr>
                                    <?php

                                    }
                                    ?>
                                    <?php
                                    // Définit les différentes valeurs pour la TVA et son rendu dans le tableau.
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
                                    <tr>
                                        <td style="visibility: hidden;"></td> <? // Les hidden servent à ne pas faire apparaitre les 2 premier TD du tableau et le rendre responsif malgré tout 
                                                                                ?>
                                        <td style="visibility: hidden;"></td>
                                        <td id="fraispanier">TVA (20%)</td>
                                        <td><?= $totaltva ?><sup>€</sup></td>
                                    </tr>
                                    <tr>
                                        <td style="visibility: hidden;"></td>
                                        <td style="visibility: hidden;"></td>
                                        <td id="fraispanier">Frais de livraison</td>
                                        <td><?= $fraislivraisonaffiche ?></td>
                                    </tr>
                                    <tr>
                                        <td style="visibility: hidden;"></td>
                                        <td style="visibility: hidden;"></td>
                                        <td id="fraispanier">Prix total (TVA + frais)</td>
                                        <td><?= $prixtotalfinalcommande ?><sup>€</sup></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <?php if ($dataCommande[0]->commande_facturation_rue == $dataCommande[0]->commande_livraison_rue && $dataCommande[0]->commande_facturation_ville == $dataCommande[0]->commande_livraison_ville && $dataCommande[0]->commande_facturation_codepo == $dataCommande[0]->commande_livraison_codepo) {
                        // Permet de catch la situation où l'adresse de facturation est identique à celle de livraison, et dans ce cas, n'affiche qu'une seule adresse, sinon affiche les deux. 

                        print '<div style="margin-top: 20px;" class="row justify-content-center">';
                        print '<div class="card" id="infoslivraison">';
                        print '<div class=card-body>';
                        print '<h5 class="card-title" id="ligne1infoslivraison">Les informations de votre commande :</h5>';
                        print '<p class="card-text" id="ligne2infoslivraison">Votre adresse de livraison et de facturation :</p>';
                        print $dataC[0]->client_prenom . ' ' . $dataC[0]->client_nom . '<br>';
                        print $dataCommande[0]->commande_facturation_rue . '<br>';
                        print $dataCommande[0]->commande_facturation_ville . '<br>';
                        print $dataCommande[0]->commande_facturation_codepo . '</p><br>';

                        print '<p class="card-text" id="ligne2infoslivraison">Divers :</p>';
                        print 'Commande passée le : ' . date('d-m-Y', strtotime($dataCommande[0]->commande_date_reglem)) . '<br>';
                        print 'Statut : '. $dataCommande[0]->commande_etat. '<br>';
                        print ' </div>';
                        print '</div>';
                        print '</div>';
                    } else {
                        print '<div style="margin-top: 20px;" class="row justify-content-center">';
                        print '<div class="card" id="infoslivraison">';
                        print '<div class=card-body>';
                        print '<h5 class="card-title" id="ligne1infoslivraison">Les informations de votre commande :</h5>';
                        print '<p class="card-text" id="ligne2infoslivraison">Votre adresse de facturation :</p>';
                        print $dataC[0]->client_prenom . ' ' . $dataC[0]->client_nom . '<br>';
                        print $dataCommande[0]->commande_facturation_rue . '<br>';
                        print $dataCommande[0]->commande_facturation_ville . '<br>';
                        print $dataCommande[0]->commande_facturation_codepo . '<br><br>';

                        print '<p class="card-text" id="ligne2infoslivraison">Votre adresse de Livraison :<br></p>';
                        print $dataC[0]->client_prenom . ' ' . $dataC[0]->client_nom . '<br>';
                        print $dataCommande[0]->commande_livraison_rue . '<br>';
                        print $dataCommande[0]->commande_livraison_ville . '<br>';
                        print $dataCommande[0]->commande_livraison_codepo . '</p><br>';

                        print '<p class="card-text" id="ligne2infoslivraison">Divers :</p>';
                        print 'Commande passée le : ' . date('d-m-Y', strtotime($dataCommande[0]->commande_date_reglem)) . '<br>';
                        print 'Statut : '. $dataCommande[0]->commande_etat. '<br>';
                        print ' </div>';
                        print '</div>';
                        print '</div>';
                    }

                    ?>

                    <div class="row justify-content-center"><a href="<?= base_url('espaceclient/espaceC') ?>">Retour vers l'espace client</a></div>

                </div>

            </div>

        </div>

<?php } else {
        redirect(""); // Parti 
    }
} else {
    redirect(""); // Parti 
}
?>