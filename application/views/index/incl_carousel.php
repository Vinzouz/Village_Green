<?php 
// Vue carousel gère l'affichage des pubs dans le grand carousel dans les pages principales du site
?>
<body>

  <section class="body">
    <section class="container">

      <!--------------->
      <!-- Carrousel -->
      <!--------------->
      <section class="d-flex flex-row justify-content-between align-content-center" id="entete">
        <section id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <!-- Petite barre horizontal d'indication en bas du carrousel -->
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
          </ol>

          <!-- Image Publicitaire du Carrousel -->
          <div class="carousel-inner" role="listbox">
            <section class="carousel-item active">
              <a href="#"><img class="boutonblanc" src=<?=base_url('assets/images/pub_guitare_bouton_blanc.png')?> alt="bouton blanc"></a>
              <img class="d-block" src=<?=base_url('assets/images/pubguitare.png')?> data-src="holder.js/900x400?theme=social" alt="First slide">
            </section>
            <section class="carousel-item">
              <a href="#"><img class="boutonblanc" src=<?=base_url('assets/images/pub_guitare_bouton_blanc.png')?> alt="bouton blanc"></a>
              <img class="d-block" src=<?=base_url('assets/images/pubpiano.png')?> data-src="holder.js/900x400?theme=industrial" alt="Second slide">
            </section>
            <section class="carousel-item">
              <a href="#"><img class="boutonblanc" src=<?=base_url('assets/images/pub_guitare_bouton_blanc.png')?> alt="bouton blanc"></a>
              <img class="d-block" src=<?=base_url('assets/images/pubbatterie.png')?> data-src="holder.js/900x400?theme=industrial" alt="Third slide">
            </section>
            <section class="carousel-item">
              <a href="#"><img class="boutonblanc" src=<?=base_url('assets/images/pub_guitare_bouton_blanc.png')?> alt="bouton blanc"></a>
              <img class="d-block" src=<?=base_url('assets/images/pubplatine.png')?> data-src="holder.js/900x400?theme=industrial" alt="Fourth slide">
            </section>
          </div>

          <!-- Boutton Gauche/Droite de défilement du carrousel -->
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </section>

        <!-- PUB Bannière de droite -->
        <section class="d-flex flex-row">
        <a href="#"><img class="img-fluid bg-white" src=<?=base_url('assets/images/banniere_droite_prix.png')?> alt="banniere droite" id="bannieredroite"></a>
        </section>
      </section>