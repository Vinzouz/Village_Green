<div class="container">
    <section class="row overlay overlay-decalage-titre">
        <h2 class="intercalaire">Venez découvrir</h2>
    </section>
    <hr>

    <div class="card-slider">
        <?php foreach ($carrousel_produit as $index) : ?>
            <section class="card__list padding_prod">
                <div class="card__box">
                    <div class="card">

                        <div class="card__img">
                            <img class="card__img-preview" src=<?= base_url('assets/images/Imagesproducts/' . $index->sousrub_rubrique_id . '/' . $index->produit_sousrub_id . '/' . $index->produit_id . '/product.jpg') ?> alt="Image name">
                        </div>
                        <div class="card__content">
                            <a href="#">
                                <h2 class="card__title"><?= $index->produit_nom ?></h2>
                            </a>

                            <p class="card__description">
                                <?= nl2br($index->produit_caract) ?>
                            </p>
                            <div class="card__bottom row">
                                <div class="options col-9 col-12">
                                    <span class="category"><i class="fa fa-tag" aria-hidden="true"></i> <?= $index->sousrub_nom ?></span>
                                    <span class="category"><i class="fa fa-tag" aria-hidden="true"></i> <?= $index->produit_marque ?></span>
                                </div>
                                <div class="card__price col-3 col-12">
                                    <?= $index->produit_prix_HT ?> €
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /card__box -->
            </section>
        <?php endforeach; ?>

    </div>
</div>