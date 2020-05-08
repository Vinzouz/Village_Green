<?php 
// Vue produits qui gère l'affichage des cards de chaque produit selon la sous-rubrique sélectionnée
?>
<?php $array = json_decode(json_encode($getSousRubrique), True); ?>
<div class="parallax" style="background-image:url('<?= base_url('assets/images/Imagesproducts/' . @$array[0]['rubrique_id'] . '/' . @$array[0]['sousrub_id'] . '/home.jpg') ?>')">
  <h1><?= @$array[0]['sousrub_nom'] ?></h1>
</div>

<section class="card__list row">
  <?php

  foreach ($getSousRubrique as $sousRubrique) : // Boucle pour parcourir chaque produit dans la sous-rubrique ?>

    <div class="card__box col-xl-6 col-md-12">
      <div class="card">

        <div class="card__img">
          <img class="card__img-preview" src=<?= base_url('assets/images/Imagesproducts/' . @$sousRubrique->sousrub_rubrique_id . '/' . @$sousRubrique->produit_sousrub_id . '/' . @$sousRubrique->produit_id . '/product.jpg') ?> alt="Image name">
        </div>
        <div class="card__content">
          <a href="<?= base_url('ficheproduit/index/'.@$sousRubrique->produit_id.'') ?>">
            <h2 class="card__title"><?= @$sousRubrique->produit_nom ?></h2>
          </a>

          <p class="card__description">
            <?= nl2br($sousRubrique->produit_caract) ?>
          </p>
          <div class="card__bottom row">
            <div class="options col-9 col-12">
              <span class="category"><i class="fa fa-tag" aria-hidden="true"></i> <?= @$sousRubrique->sousrub_nom ?></span>
              <span class="category"><i class="fa fa-tag" aria-hidden="true"></i> <?= @$sousRubrique->produit_marque ?></span>
            </div>
            <div class="card__price col-3 col-12">
              <?= @$sousRubrique->produit_prix_HT ?> €       
            </div>
          </div>
        </div>
      </div>
    </div><!-- /card__box -->

  <?php endforeach; ?>
</section>