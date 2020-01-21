<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Ajouter une rubrique</h4>

            <form action="<?= base_url('adminrubriques/addrubrique') ?>" method="post" class="forms-sample">


                <!-- Produit nom -->
                <div class="form-group">
                    <label for="exampleInputEmail3">Nom rubrique</label>
                    <input type="text" class="form-control" name="rubrique_nom" id="exampleInputEmail3">
                </div>

                <!-- Produit description -->
                <div class="form-group">
                    <label for="exampleTextarea1">Description de la rubrique</label>
                    <textarea class="form-control" name="rubrique_desc" id="exampleTextarea1" rows="5"></textarea>
                </div>

                <button type="submit" class="btn btn-success mr-2">Envoyer</button>
                <button class="btn btn-light">Annuler</button>

            </form>
        </div>
    </div>
</div>