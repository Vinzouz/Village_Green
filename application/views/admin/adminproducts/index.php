<?php //print_r($users->row_array); 
?>
<div class="main-panel">

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Listes des produits</h4>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID produit</th>
                        <th>Marque produit</th>
                        <th>Nom produit</th>
                        <th>Prix produit HT</th>
                        <th>Sous rubrique produit</th>
                        <th>Quantité produit</th>
                        <th>Modifier / Supprimer</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($products->result() as $product) { 
                        
                        ?>
                        <tr>
                            <td><?= $product->produit_id ?></td>
                            <td><?= $product->produit_marque ?></td>
                            <td><?= $product->produit_nom ?></td>
                            <td><?= $product->produit_prix_HT ?></td>
                            <td><?= $product->produit_sousrub_id ?></td>
                            <td><?= $product->produit_qtite ?></td>
                            <td><p><a href="<?= site_url("adminproducts/editProduct/$product->produit_id") ?>">Modifier</a> / <a href="<?= site_url("adminproducts/deleteProduct/$product->produit_id") ?>">Supprimer</a></p></td>
                        </tr>

                    <?php
                    }
                    ?>


                </tbody>
            </table>
        </div>
    </div>
</div>