<div class="main-panel">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Modifier une sous-rubrique</h4>

                <form action="<?= base_url('adminsousrubriques/updatesousrubrique') ?>" method="post" class="forms-sample">

                    <!-- Produit sous rubrique id -->
                    <div class="form-group">
                        <label for="exampleInput">Rubrique du produit</label>
                        <select class="form-control" name="sousrub_rubrique_id">
                            <?php foreach ($getProRubriques->result() as $rubrique) {
                                if ($rubrique->rubrique_id == $data['sousrub_rubrique_id']) { ?>
                                    <option selected="selected" value="<?= @$data['sousrub_rubrique_id'] ?>"> <?= $rubrique->rubrique_nom ?></option>
                                <?php } else { ?> ?>

                                    <option value="<?= $rubrique->rubrique_id ?>"> <?= $rubrique->rubrique_nom ?></option>

                            <?php   }
                            } ?>
                        </select>
                    </div>

                    <!-- Produit nom -->
                    <div class="form-group">
                        <label for="exampleInputEmail3">Nom sous-rubrique</label>
                        <input type="text" class="form-control" name="sousrub_nom" id="exampleInputEmail3" value="<?= @$data['sousrub_nom'] ?>">
                    </div>

                    <!-- Produit description -->
                    <div class="form-group">
                        <label for="exampleTextarea1">Description de la sous-rubrique</label>
                        <textarea class="form-control" name="sousrub_desc" id="exampleTextarea1" rows="5"><?= @$data['sousrub_desc'] ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-success mr-2">Envoyer</button>
                    <button class="btn btn-light">Annuler</button>

                </form>
            </div>
        </div>
    </div>