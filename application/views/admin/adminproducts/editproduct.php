<div class="main-panel">
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Modifier un produit</h4>

            <!-- <form action="" method="post" class="forms-sample" enctype="multipart/form-data"> -->
            <?php foreach ($getSousRubriqueP as $sousRubriqueP) { ?>
            <?= form_open_multipart(base_url('adminproducts/updateproduct/' . @$sousRubriqueP->sousrub_rubrique_id . '/' . @$sousRubriqueP->produit_sousrub_id . '/' . @$sousRubriqueP->produit_id . '/product.jpg')) ?>
            <?php } ?>
            <!-- Produit marque -->
            <div class="form-group">
                <label for="exampleInputName1">Marque produit</label>
                <input type="text" class="form-control" name="produit_marque" id="exampleInputName1" placeholder="Marque" value="<?= @$data['produit_marque'] ?>">
            </div>

            <!-- Produit nom -->
            <div class="form-group">
                <label for="exampleInputEmail3">Nom produit</label>
                <input type="text" class="form-control" name="produit_nom" id="exampleInputEmail3" placeholder="Nom produit" value="<?= @$data['produit_nom'] ?>">
            </div>

            <!-- Produit prix HT -->
            <div class="form-group">
                <label for="exampleInputPassword4">Prix produit HT</label>
                <input type="text" class="form-control" name="produit_prix_HT" id="exampleInputPassword4" placeholder="Prix HT" value="<?= @$data['produit_prix_HT'] ?>">
            </div>

            <!-- Produit caractéristiques -->
            <div class="form-group">
                <label for="exampleInputPassword4">Caractéristiques du produit</label>
                <!-- The button used to copy the text -->
                <label class="btn btn-light" onclick="myFunction()">✔️</label>
                <textarea type="text" class="form-control" name="produit_caract" id="exampleInputPassword4" rows="10" ><?= @$data['produit_caract'] ?> </textarea>
            </div>

            <!-- Produit sous rubrique id -->
            <div class="form-group">
                <label for="exampleInput">Rubrique du produit</label>
                <select class="form-control" name="produit_rub_id">
                    <?php foreach ($getProRubriques->result() as $rubrique) { 
                        if($rubrique->rubrique_id == $data['sousrub_rubrique_id']){ ?>
                            <option selected="selected" value="<?= @$data['sousrub_rubrique_id'] ?>"> <?= $rubrique->rubrique_nom ?></option>
                        <?php }else{ ?>    

                        <option value="<?= $rubrique->rubrique_id ?>"> <?= $rubrique->rubrique_nom ?></option>

                    <?php  }  } ?>
                </select>
            </div>


            <!-- Produit sous rubrique id -->
            <div class="form-group">
                <label for="exampleInputPassword4">Sous-rubrique du produit</label>
                <select class="form-control" name="produit_sousrub_id" id="exampleInputPassword4">
                    <?php foreach ($getSousRubriques->result() as $sousrubrique) { 
                        if($sousrubrique->sousrub_id == $data['produit_sousrub_id']){ ?>
                            <option selected="selected" value="<?= @$data['produit_sousrub_id'] ?>"> <?= $sousrubrique->sousrub_nom ?></option>
                    <?php    }else{ ?>
                        <option value="<?= $sousrubrique->sousrub_id ?>"> <?= $sousrubrique->sousrub_nom ?></option>

                    <?php   } } ?>
                </select>
            </div>

            <!-- Produit quantité -->
            <div class="form-group">
                <label for="exampleInputPassword4">Quantité du produit</label>
                <input type="text" class="form-control" name="produit_qtite" id="exampleInputPassword4" value="50" value="<?= @$data['produit_qtite'] ?>">
            </div>

            <!-- Produit quantité alerte -->
            <div class="form-group">
                <label for="exampleInputPassword4">Quantité minimale du produit</label>
                <input type="text" class="form-control" name="produit_qtite_ale" id="exampleInputPassword4" value="10" value="<?= @$data['produit_qtite_ale'] ?>">
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
            <?php
            foreach ($getSousRubriqueP as $sousRubriqueP) { ?>

            <section class="card-image">
                <img src=<?= base_url('assets/images/Imagesproducts/' . @$sousRubriqueP->sousrub_rubrique_id . '/' . @$sousRubriqueP->produit_sousrub_id . '/' . @$sousRubriqueP->produit_id . '/product.jpg') ?> alt="Catégorie" style='width: 200px;height:300px;' />
            </section>
                <?php } ?>
            <button type="submit" class="btn btn-success mr-2">Envoyer</button>
            <button class="btn btn-light">Annuler</button>

            <?php
            echo form_close();
            ?>
        </div>
    </div>
</div>

<script>
    function myFunction() {

  /* Get the text field */
  var copyText = navigator.clipboard.writeText('✔️');

  /* Copy the text inside the text field */
  document.execCommand("copy");

}
</script>