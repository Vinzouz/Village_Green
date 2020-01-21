      <!--------------------------------->
      <!-- Catégorie et Sous-Catégorie -->
      <!--------------------------------->
      <?php //print_r($getRubriques) ?>
      <section class="row overlay">

        <ul class="card-list overlay-categorie overlay-decalage-categorie">

          <?php foreach ($getRubriques as $rubrique) : ?>

            <!-- Catégorie 1 -->
            <a href="<?= base_url('products/getSousrubrique/').$rubrique['rubrique_id'] ?>">
            <li class="card categorie">
              
              <section class="card-image">
                <img src=<?= base_url('assets/images/Imagesproducts/' . $rubrique['rubrique_id'] . '/home.jpg') ?> alt="Psychopomp" />
              </section>
              <section class="card-description">
                <span>
                  <h2><?= $rubrique['rubrique_nom'] ?></h2>
                </span>
                <section class="souscategorie">

                  <?php
                  $childes = $rubrique['child'];
                  foreach($childes as $child):
                  ?>
                  <a href="<?= base_url('products/getProducts/').$child['sousrub_id'] ?>"><?= $child['sousrub_nom'] ?></a><br>
                  <?php
                  endforeach;
                  ?>
                </section>
              </section>
            </li>
            </a>
          <?php endforeach ?>

        </ul>
      </section>
      <br>