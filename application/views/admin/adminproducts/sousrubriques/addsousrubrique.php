<div class="main-panel">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ajouter une sous-rubrique</h4>

                <?= form_open_multipart(base_url('adminsousrubriques/addsousrubrique')) ?>

                <!-- Produit sous rubrique id -->
                <div class="form-group">
                    <label for="exampleInput">Rubrique du produit</label>
                    <select class="form-control" name="sousrub_rubrique_id">
                        <?php foreach ($getProRubriques->result() as $rubrique) { ?>

                            <option value="<?= $rubrique->rubrique_id ?>"> <?= $rubrique->rubrique_nom ?></option>

                        <?php    } ?>
                    </select>
                </div>

                <!-- Produit nom -->
                <div class="form-group">
                    <label for="exampleInputEmail3">Nom sous-rubrique</label>
                    <input type="text" class="form-control" name="sousrub_nom" id="exampleInputEmail3">
                </div>

                <!-- Produit description -->
                <div class="form-group">
                    <label for="exampleTextarea1">Description de la sous-rubrique</label>
                    <textarea class="form-control" name="sousrub_desc" id="exampleTextarea1" rows="5"></textarea>
                </div>

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