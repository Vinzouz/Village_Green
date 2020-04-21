<div class="main-panel">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Modifier une commande</h4>

                <?= form_open_multipart(base_url('admincommandes/updateCommande')) ?>

                    <!-- ID Commande -->
                    <div class="form-group">
                        <label for="IdCommande">ID Commande</label>
                        <input type="text" class="form-control" name="IdCommande" id="IdCommande" value="<?= @$data['commande_id'] ?>">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="DateCommande">Date de la commande</label>
                        <input type="text" class="form-control" name="DateCommande" id="DateCommande" value="<?= @$data['commande_date'] ?>">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="ReducCommande">Réduction commande</label>
                        <input type="text" class="form-control" name="ReducCommande" id="ReducCommande" value="<?= @$data['commande_reduc'] ?>">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="PrixtotCommande">Prix total de la commande</label>
                        <input type="text" class="form-control" name="PrixtotCommande" id="PrixtotCommande" value="<?= @$data['commande_prix_tot'] ?>€">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="DatereglemCommande">Date de réglement de la commande</label>
                        <input type="text" class="form-control" name="DatereglemCommande" id="DatereglemCommande" value="<?= @$data['commande_date_reglem'] ?>">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="DatefactureCommande">Date de facture de la commande</label>
                        <input type="text" class="form-control" name="DatefactureCommande" id="DatefactureCommande" value="<?= @$data['commande_date_facture'] ?>">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="AdresselivraisonCommande">Adresse de livraison de la commande</label>
                        <input type="text" class="form-control" name="AdresselivraisonCommande" id="AdresselivraisonCommande" value="<?= @$data['commande_livraison_rue'] ?>">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="VillelivraisonCommande">Ville de livraison de la commande</label>
                        <input type="text" class="form-control" name="VillelivraisonCommande" id="VillelivraisonCommande" value="<?= @$data['commande_livraison_ville'] ?>">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="CodepolivraisonCommande">Code postal de livraison de la commande</label>
                        <input type="text" class="form-control" name="CodepolivraisonCommande" id="CodepolivraisonCommande" value="<?= @$data['commande_livraison_codepo'] ?>">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="AdressefacturationCommande">Adresse de facturation de la commande</label>
                        <input type="text" class="form-control" name="AdressefacturationCommande" id="AdressefacturationCommande" value="<?= @$data['commande_facturation_rue'] ?>">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="VillefacturationCommande">Ville de facturation de la commande</label>
                        <input type="text" class="form-control" name="VillefacturationCommande" id="VillefacturationCommande" value="<?= @$data['commande_facturation_ville'] ?>">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="CodepofacturationCommande">Code postal de facturation de la commande</label>
                        <input type="text" class="form-control" name="CodepofacturationCommande" id="CodepofacturationCommande" value="<?= @$data['commande_facturation_codepo'] ?>">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleInput">Etat de la commande</label>
                        <select class="form-control" name="EtatCommande">
                            <?php if ($data['commande_etat'] == 'En cours de validation') { ?>
                                    <option selected="selected" value="<?= @$data['commande_etat'] ?>"> <?= @$data['commande_etat'] ?></option>
                                <?php } ?>

                                    <option value="En cours de livraison">En cours de livraison</option>
                                    <option value="Livrée">Livrée</option>
                                    <option value="Annulée">Annulée</option>
                        
                        </select>
                    </div>

                    <br>
                    <div class="form-group">
                        <label for="ClientidCommande">ID client de la commande</label>
                        <input type="text" class="form-control" name="ClientidCommande" id="ClientidCommande" value="<?= @$data['commande_client_id'] ?>">
                    </div>


                    <button type="submit" class="btn btn-success mr-2">Envoyer</button>
                    <button class="btn btn-light">Annuler</button>

                    <?php
                echo form_close();
                ?>
            </div>
        </div>
    </div>