<div class="container">
<?php $array = json_decode(json_encode($getRubrique), True); ?>
    <div class="parallax" style="background-image:url('<?= base_url('assets/images/Imagesproducts/' . $array[0]['rubrique_id'] . '/home.jpg') ?>')">
        <h1><?= $array[0]['rubrique_nom'] ?></h1>
    </div>

    <!--------------------------------->
    <!--------Sous-Catégorie ---------->
    <!--------------------------------->

    <section class="row overlay">

        <ul class="card-list overlay-categorie overlay-decalage-categorie">

            <?php foreach ($getRubrique as $rubrique) : ?>

                <!-- Catégorie -->
                <a href="<?= base_url('products/getSousRubrique/') . $rubrique->sousrub_id ?>">
                    <li class="card categorie">

                        <section class="card-image">
                            <img src=<?= base_url('assets/images/Imagesproducts/' . $rubrique->rubrique_id . '/' . $rubrique->sousrub_id .'/home.jpg') ?> alt="Catégorie" />
                        </section>
                        <section class="card-description_sousrub">
                            <h2><a href="<?= base_url('products/getSousRubrique/') . $rubrique->sousrub_id ?>"><?= $rubrique->sousrub_nom ?></a><br></h2>
                        </section>
                    </li>
                </a>
            <?php endforeach; ?>

        </ul>
    </section>
    <br>
</div>