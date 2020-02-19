<div class="main-panel">
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Modifier une rubrique</h4>

            <form action="<?= site_url("adminrubriques/updateRubrique/$data[rubrique_id]") ?>" method="post" class="forms-sample">


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

                <button type="submit" class="btn btn-success mr-2">Envoyer</button>
                <button class="btn btn-light">Annuler</button>

            </form>
        </div>
    </div>
</div>