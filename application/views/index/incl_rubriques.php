<?php 
// Vue rubriques qui gère l'affichage des rubriques et de leurs sous-rubriques dans les pages principales du site
?>
      <section class="row overlay">

        <ul class="card-list overlay-categorie overlay-decalage-categorie">

          <?php foreach ($getRubriques as $rubrique) : // Boucle foreach pour parcourir chaque rubriques envoyé par la fonction getRubrique ?>

            <!-- Catégorie -->
            <a href="<?= base_url('products/getRubrique/') . $rubrique['rubrique_id'] ?>">
              <li class="card categorie">

                <section class="card-image">
                  <img src=<?= base_url('assets/images/Imagesproducts/' . $rubrique['rubrique_id'] . '/home.jpg') ?> alt="Catégorie" />
                </section>
                <section class="card-description">
                  <span>
                    <h2><?= $rubrique['rubrique_nom'] ?></h2>
                  </span>
                  <section class="souscategorie">

                    <?php
                    $childes = $rubrique['child'];
                    foreach ($childes as $child) : // 2ème boucle foreach pour parcourir chaque sous-rubriques de chaque rubrique
                    ?>
                      <a href="<?= base_url('products/getSousRubrique/') . $child['sousrub_id'] ?>"><?= $child['sousrub_nom'] ?></a><br>
                    <?php
                    endforeach;
                    ?>
                  </section>
                </section>
              </li>
            </a>
          <?php endforeach; ?>

        </ul>
      </section>
      <br>