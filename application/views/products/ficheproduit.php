<?php 
// Vue ficheproduit qui gère l'affichage de la fiche du produit selon l'id du produit
?>
<div class="container">

<section class="card__list row">
<div class="card__box col-xl-12 col-md-12">
<div class="card2">


<div class="card2__img">
  <img class="card2__img-preview" src=<?= base_url('assets/images/Imagesproducts/' . @$jointureSousrubRub[0]['rubrique_id'] . '/' . @$jointureSousrubRub[0]['sousrub_id'] . '/' . @$jointureSousrubRub[0]['produit_id'] . '/product.jpg') ?> alt="Image name">
</div>


<div class="card2__content">
	<h2 class="card2__title"><?= @$getdataProduit[0]['produit_marque'] . ' : ' . @$getdataProduit[0]['produit_nom']?></h2>


  <p class="card2__description">
	<?= nl2br(@$getdataProduit[0]['produit_caract']) ?>
  </p>
  
  <div class="row aaaa">
  <select class="form-control card-control" name="pro_qte" id="pro_qte">
		<?php
		for ($i = 1; $i < 11; $i++) {
			echo "<option value=" . '"' . $i . '"' . ">" . $i . "</option>";
		}
		?>
	</select>

	<input type="hidden" name="pro_id" id="pro_id" value="<?= @$getdataProduit[0]['produit_id'] ?>">

	<button type="submit" id="ajoutP">Ajouter au panier</button>
</div>


  <div class="card2__bottom row aaaa">
	<div class="options col-9 col-12">
	  <span class="category"><i class="fa fa-tag" aria-hidden="true"></i> <?= @$jointureSousrubRub[0]['rubrique_nom'] ?></span>
	  <span class="category"><i class="fa fa-tag" aria-hidden="true"></i> <?= @$jointureSousrubRub[0]['sousrub_nom'] ?></span>
	  <span class="category"><i class="fa fa-tag" aria-hidden="true"></i> <?= @$getdataProduit[0]['produit_marque'] ?></span>
	</div>

	
	<div class="card2__price col-3 col-12">
	  <?= @$getdataProduit[0]['produit_prix_HT'] ?> €       
	</div>
  </div>
</div>
</div>

</div>

</div>
</div>
</div>
</div>