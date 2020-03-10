<div class="main-panel">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Modifier une rubrique</h4>
                <?= form_open_multipart(base_url('adminrubriques/updateRubrique/'.$data['rubrique_id'].'')) ?>



                <!-- Produit nom -->
                <div class="form-group">
                    <label for="exampleInputEmail3">Nom rubrique</label>
                    <input type="text" class="form-control" name="rubrique_nom" id="exampleInputEmail3" value="<?= @$data['rubrique_nom'] ?>">
                </div>

                <!-- Produit description -->
                <div class="form-group">
                    <label for="exampleTextarea1">Description de la rubrique</label>
                    <textarea class="form-control" name="rubrique_desc" id="exampleTextarea1" rows="5" value="<?= @$data['rubrique_desc'] ?>"></textarea>
                </div>

                <section class="card-image">
                    <img src=<?= base_url('assets/images/Imagesproducts/' . @$data['rubrique_id'] . '/home.jpg') ?> alt="Catégorie" style='width: 400px;height:300px;' />
                </section>
                <br>
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


                <button type="submit" class="btn btn-success mr-2">Envoyer</button>
                <button class="btn btn-light">Annuler</button>

                <?php
                echo form_close();
                ?>
            </div>
        </div>
    </div>