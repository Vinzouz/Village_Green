<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Ajouter un produit</h4>

            <!-- <form action="" method="post" class="forms-sample" enctype="multipart/form-data"> -->
            <?= form_open_multipart(base_url('adminproducts/addproduct')) ?>
            <!-- Produit marque -->
            <div class="form-group">
                <label for="exampleInputName1">Marque produit</label>
                <input type="text" class="form-control" name="produit_marque" id="exampleInputName1" placeholder="Marque">
            </div>

            <!-- Produit nom -->
            <div class="form-group">
                <label for="exampleInputEmail3">Nom produit</label>
                <input type="text" class="form-control" name="produit_nom" id="exampleInputEmail3" placeholder="Nom produit">
            </div>

            <!-- Produit prix HT -->
            <div class="form-group">
                <label for="exampleInputPassword4">Prix produit HT</label>
                <input type="text" class="form-control" name="produit_prix_HT" id="exampleInputPassword4" placeholder="Prix HT">
            </div>

            <!-- Produit caractéristiques -->
            <div class="form-group">
                <label for="exampleInputPassword4">Caractéristiques du produit</label>
                <input type="text" class="form-control" name="produit_caract" id="exampleInputPassword4">
            </div>

                        <!-- Produit sous rubrique id -->
                        <div class="form-group">
                <label for="exampleInput">Rubrique du produit</label>
                <select class="form-control" name="produit_rub_id">
                    <?php foreach ($getProRubriques->result() as $rubrique) { ?>

                        <option value="<?= $rubrique->rubrique_id ?>"> <?= $rubrique->rubrique_nom ?></option>

                    <?php    } ?>
                </select>
            </div>


            <!-- Produit sous rubrique id -->
            <div class="form-group">
                <label for="exampleInputPassword4">Sous-rubrique du produit</label>
                <select class="form-control" name="produit_sousrub_id" id="exampleInputPassword4">
                    <?php foreach ($getSousRubriques->result() as $sousrubrique) { ?>

                        <option value="<?= $sousrubrique->sousrub_id ?>"> <?= $sousrubrique->sousrub_nom ?></option>

                    <?php    } ?>
                </select>
            </div>

            <!-- Produit quantité -->
            <div class="form-group">
                <label for="exampleInputPassword4">Quantité du produit</label>
                <input type="text" class="form-control" name="produit_qtite" id="exampleInputPassword4">
            </div>

            <!-- Produit quantité alerte -->
            <div class="form-group">
                <label for="exampleInputPassword4">Quantité minimale du produit</label>
                <input type="text" class="form-control" name="produit_qtite_ale" id="exampleInputPassword4">
            </div>

            <!-- Produit photo -->
            <div class="form-group">
                <label>Télécharger l'image</label>
                <div>
                    <?php
                    $data = array(
                        'name' => 'image_file',
                        'size' => '20'
                    );
                    echo form_upload($data); ?>
                </div>
            </div>

            <!-- Produit description -->
            <div class="form-group">
                <label for="exampleTextarea1">Description du produit</label>
                <textarea class="form-control" name="produit_desc" id="exampleTextarea1" rows="5"></textarea>
            </div>

            <button type="submit" class="btn btn-success mr-2">Envoyer</button>
            <button class="btn btn-light">Annuler</button>

            <?php
            echo form_close();
            ?>
        </div>
    </div>
</div>