<div class="container">

    <?php
    if ($this->session->panier != null) {
    ?>
    <p><h2 class="titrepanier">Votre panier :</h2></p>
        <div class="table-responsive" id="tabpanier">
            <table class="table table-striped table-hover table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Produit</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Prix total</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    $i = 0;
                    $newtab = $this->session->panier;
                    foreach ($newtab as $produit) {
                    ?>
                        <tr>
                            <td><?= $newtab[$i][0]['produit_nom']; ?></td>
                            <td><?= str_replace('.', ',', $newtab[$i][0]['produit_prix_HT']); ?> <sup>€</sup></td>
                            <td>
                                <div class="panier_qte">
                                    <div class="panier_qte_valeur">
                                        <a href="<?= site_url('panier/qtemoins/' . $newtab[$i][0]['produit_id']); ?>" role="button"><i type="button" class="fas fa-minus-square"></i></a>
                                        <?= $newtab[$i][1] ?>
                                        <a href="<?= site_url('panier/qteplus/' . $newtab[$i][0]['produit_id']); ?>" role="button"><i type="button" class="fas fa-plus-square"></i></a>
                                    </div>
                                </div>
                            </td>
                            <td><?= str_replace('.', ',', ($newtab[$i][1] * $newtab[$i][0]['produit_prix_HT'])); ?> <sup>€</sup></td>
                            <td>
                                <?php
                                $total += $newtab[0][1] * $newtab[$i][0]['produit_prix_HT']; ?>
                                <a href="<?= site_url('panier/effaceProduit/' . $newtab[$i][0]['produit_id']); ?>"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php $i++;
                    }

                    ?>
                </tbody>
            </table>
        </div>
        <div>
            <div>
                <div>
                    <h5 class="titrepanier">TOTAL : <?= str_replace('.', ',', $total); ?> <sup>€</sup></h5>
                    <a href="<?= site_url("panier/effacePanier"); ?>">Supprimer le panier</a> -
                    <a href="<?= site_url("produits/liste"); ?>">Retour boutique</a>
                </div>
            </div>
        </div>
</div>
<?php
    } else {
?>
    <div style="width: 250px;  margin: auto;" class="alert alert-danger">Votre panier est vide. Pour le remplir, vous pouvez visiter notre <a href="<?= site_url("produits/liste"); ?>">boutique</a>.</div>
<?php
    }
?>
</div>