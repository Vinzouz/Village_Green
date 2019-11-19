<!DOCTYPE html>
<html lang="fr">

<?php include("Ext_head.php"); ?>
<title>Village Green Accueil</title>
</head>

<body>
  <?php include("Ext_header.php"); ?>


  <section class="body">
    <section class="container">

      <!--------------->
      <!-- Carrousel -->
      <!--------------->
      <section class="d-flex flex-row justify-content-around align-content-center" id="entete">
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
              <a href="#"><img class="boutonblanc" src="images/pub_guitare_bouton_blanc.png" alt="bouton blanc"></a>
              <img class="d-block" src="images/pubguitare.png" data-src="holder.js/900x400?theme=social" alt="First slide">
            </section>
            <section class="carousel-item">
              <a href="#"><img class="boutonblanc" src="images/pub_guitare_bouton_blanc.png" alt="bouton blanc"></a>
              <img class="d-block" src="images/pubpiano.jpg" data-src="holder.js/900x400?theme=industrial" alt="Second slide">
            </section>
            <section class="carousel-item">
              <a href="#"><img class="boutonblanc" src="images/pub_guitare_bouton_blanc.png" alt="bouton blanc"></a>
              <img class="d-block" src="images/pubbatterie.png" data-src="holder.js/900x400?theme=industrial" alt="Third slide">
            </section>
            <section class="carousel-item">
              <a href="#"><img class="boutonblanc" src="images/pub_guitare_bouton_blanc.png" alt="bouton blanc"></a>
              <img class="d-block" src="images/pubplatine.png" data-src="holder.js/900x400?theme=industrial" alt="Fourth slide">
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
          <img class="img-fluid bg-white" src="images/banniere_droite_prix.png" alt="banniere droite" id="bannieredroite">
        </section>
      </section>

      <!-- Bannière Horizontal sur les avantages -->
      <section class="container p-0" id="Degrade">
        <section class="row text-center">

          <!-- Segment 1 -->
          <section class="col-3 text-center pt-2 pb-2"><img class="img-fluid" src="images/free-delivery.png" alt="free delivery">
            <h5 class="banderole">Livraison gratuite</h5>
            <h6 class="banderole">A partir de 19€</h6>
          </section>

          <!-- Segment 2 -->
          <section class="col-3 text-center pt-2 pb-2"><img class="img-fluid" src="images/guarantee.png" alt="guarantee">
            <h5 class="banderole">Garantie</h5>
            <h6 class="banderole">3 ans</h6>
          </section>

          <!-- Segment 3 -->
          <section class="col-3 text-center pt-2 pb-2"><img class="img-fluid" src="images/calendar.png" alt="calendar">
            <h5 class="banderole">Satisfait ou remboursé</h5>
            <h6 class="banderole">30 jours d'essai</h6>
          </section>

          <!-- Segment 4 -->
          <section class="col-3 text-center pt-2 pb-2"><img class="img-fluid" src="images/protected.png" alt="protected">
            <h5 class="banderole">Sécurité de payement</h5>
          </section>
        </section>
      </section>

      <!--------------------------------->
      <!-- Catégorie et Sous-Catégorie -->
      <!--------------------------------->
      <section class="row">

        <ul class="card-list">

        <!-- Catégorie 1 -->
          <li class="card categorie">
            <section class="card-image">
              <img src="Images/Guitare&Basses.jpg" alt="Psychopomp" />
            </section>
            <section class="card-description">
              <a href="Guitares&Basses.php">
                <h2>Guitares & Basses</h2>
              </a>
              <section class="souscategorie">
                <br>
                <br>
                <a href="">Basses</a><br>
                <a href="">Guitares acoustiques</a><br>
                <a href="">Guitares classiques</a><br>
                <a href="">Guitare électriques</a><br>
                <a href="">Guitare électro acoustiques</a><br>
                <a href="">Guitare pour gauchers</a><br>
                <a href="">Instruments sectioners</a><br>
                <a href="">Ukulélés</a><br>
              </section>
            </section>
          </li>

          <!-- Catégorie 2 -->
          <li class="card categorie">
            <section class="card-image">
              <img src="Images/Batteries.jpg" alt="Psychopomp" />
            </section>
            <section class="card-description">
              <a href="">
                <h2>Batteries</h2>
              </a>
              <section class="souscategorie">
                <br>
                <br>
                <a href="">Batteries acoustiques</a><br>
                <a href="">Batteries électroniques</a><br>
                <a href="">Caisses claires</a><br>
                <a href="">Cymbales</a><br>
                <a href="">Marching et Fanfare</a><br>
                <a href="">Musicothérapie</a><br>
                <a href="">Percussions</a><br>
                <a href="">Xylophones et Carillons</a><br>
              </section>
            </section>
          </li>

          <!-- Catégorie 3 -->
          <li class="card categorie">
            <section class="card-image">
              <img src="Images/Clavier.jpg" alt="Psychopomp" />
            </section>
            <section class="card-description">
              <a href="">
                <h2>Clavier</h2>
              </a>
              <section class="souscategorie">
                <br>
                <br>
                <a href="">Accordéons</a><br>
                <a href="">Claviers arrangeurs</a><br>
                <a href="">Claviers maîtres</a><br>
                <a href="">Claviers orientaux</a><br>
                <a href="">Orgues et Clavecins</a><br>
                <a href="">Pianos numériques</a><br>
                <a href="">Percussions</a><br>
              </section>
            </section>
          </li>

          <!-- Catégorie 4 -->
          <li class="card categorie">
            <section class="card-image">
              <img src="Images/Studio.jpg" alt="Psychopomp" />
            </section>
            <section class="card-description">
              <a href="">
                <h2>Studio</h2>
              </a>
              <section class="souscategorie">
                <a href="">Casques et Gestions</a><br>
                <a href="">Enceintes de monitoring</a><br>
                <a href="">Enregistrement</a><br>
                <a href="">Format 500 et Modulaire</a><br>
                <a href="">Informatique</a><br>
                <a href="">Interfaces audio</a><br>
                <a href="">M.A.O</a><br>
                <a href="">Microphones</a><br>
                <a href="">Mixage et Production</a><br>
                <a href="">Périphériques numériques</a><br>
                <a href="">Périphériques analogiques</a><br>
              </section>
            </section>
          </li>

          <!-- Catégorie 5 -->
          <li class="card categorie">
            <section class="card-image">
              <img src="Images/Sonorisation.jpg" alt="Psychopomp" />
            </section>
            <section class="card-description">
              <a href="">
                <h2>Sonorisation</h2>
              </a>
              <section class="souscategorie">
                <br>
                <br>
                <br>
                <br>
                <br>
                <a href="">Amplis de puissance</a><br>
                <a href="">Effets voix</a><br>
                <a href="">Enceintes actives</a><br>
                <a href="">Enceintes passives</a><br>
              </section>
            </section>
          </li>

          <!-- Catégorie 6 -->
          <li class="card categorie">
            <section class="card-image">
              <img src="Images/Eclairage.jpg" alt="Psychopomp" />
            </section>
            <section class="card-description">
              <a href="">
                <h2>Éclairage</h2>
              </a>
              <section class="souscategorie">
                <br>
                <br>
                <br>
                <br>
                <a href="">Décorations</a><br>
                <a href="">Lasers</a><br>
                <a href="">Projecteurs</a><br>
                <a href="">Stroboscopes</a><br>
                <a href="">Vidéo</a><br>
              </section>
            </section>
          </li>

          <!-- Catégorie 7 -->
          <li class="card categorie">
            <section class="card-image">
              <img src="Images/DJ.jpg" alt="Psychopomp" />
            </section>
            <section class="card-description">
              <a href="">
                <h2>DJ</h2>
              </a>
              <section class="souscategorie">
                <br>
                <a href="">Casques</a><br>
                <a href="">Cellules & Diamants</a><br>
                <a href="">Effets </a><br>
                <a href="">Groove stations & Samplers</a><br>
                <a href="">Karaoké</a><br>
                <a href="">Mixeurs numériques</a><br>
                <a href="">Platines CD</a><br>
                <a href="">Tables de mixage DJ</a><br>
                <a href="">Platines vinyles</a><br>
              </section>
            </section>
          </li>

          <!-- Catégorie 8 -->
          <li class="card categorie">
            <section class="card-image">
              <img src="Images/Flight.jpg" alt="Psychopomp" />
            </section>
            <section class="card-description">
              <a href="">
                <h2>Flight cases</h2>
              </a>
              <section class="souscategorie">
                <br>
                <br>
                <br>
                <a href="">Batteries & Percussions</a><br>
                <a href="">DJ</a><br>
                <a href="">Éléments rackables</a><br>
                <a href="">Pièces détachées</a><br>
                <a href="">Sac & Flight cases pour lumières</a><br>
                <a href="">Sonorisation</a><br>
              </section>
            </section>
          </li>

          <!-- Catégorie 9 -->
          <li class="card categorie">
            <section class="card-image">
              <img src="Images/Accessoires.jpg" alt="Psychopomp" />
            </section>
            <section class="card-description">
              <a href="">
                <h2>Accessoires</h2>
              </a>
              <section class="souscategorie">
                <br>
                <br>
                <br>
                <a href="">Accessoires Guitares</a><br>
                <a href="">Accessoires Batteries</a><br>
                <a href="">Accessoires Claviers</a><br>
                <a href="">Accessoires Sonorisation</a><br>
                <a href="">Accessoires Éclairage</a><br>
                <a href="">Accessoires DJ</a><br>
              </section>
            </section>
          </li>
        </ul>
      </section>
      <br>

      <!-------------------->
      <!-- Nos Partenaire -->
      <!-------------------->
      <section class="row">
        <h2 class="nospartenaire">Nos partenaires</h2>
      </section>
      <hr>
      <section class="row total">

        <!-- Partenaire 1 -->
        <section class="card part">
          <section class="face face1">
            <section class="content parts">
              <img id="roland" src="Images/Roland.png" alt="Roland-Logo">
            </section>
          </section>
          <section class="face face2">
            <section class="content parts">
              <p>Roland Corporation, connue sous le nom de Roland, est une entreprise fabriquant des instruments de
                musique électroniques. Elle a été fondée le 18 avril 1972 par Ikutaro Kakehashi à Ōsaka.</p>
              <a target="_blank" href="https://www.roland.com/fr/">Plus d'infos</a>
            </section>
          </section>
        </section>

        <!-- Partenaire 2 -->
        <section class="card part">
          <section class="face face1">
            <section class="content parts">
              <img src="Images/sennheiser-png-2017-present-sennheiser-2017-1821.png" alt="Sennheiser-Logo">
            </section>
          </section>
          <section class="face face2">
            <section class="content parts">
              <p>Sennheiser electronic GmbH & Co. KG est une entreprise allemande qui fabrique des microphones, casques,
                accessoires téléphoniques, casques d'aviateur et du matériel pour les professionnels.</p>
              <a target="_blank" href="https://fr-fr.sennheiser.com/?gclid=Cj0KCQjwuNbsBRC-ARIsAAzITuff9PJzel4C9nrqgZE-w-wghYD8FXmW8W6gM_KLTmRiat6Z9NsuTF4aAgEREALw_wcB&gclsrc=aw.ds">Plus
                d'infos</a>
            </section>
          </section>
        </section>

        <!-- Partenaire 3 -->
        <section class="card part">
          <section class="face face1">
            <section class="content parts">
              <img src="Images/yamaha.png" alt="Yamaha-Logo">
            </section>
          </section>
          <section class="face face2">
            <section class="content parts">
              <p>Yamaha (ヤマハ株式会社, Yamaha kabushiki-gaisha) est une entreprise japonaise opérant dans de nombreux
                domaines, parmi lesquels les instruments de musique, son activité première.</p>
              <a target="_blank" href="https://fr.yamaha.com/index.html">Plus d'infos</a>
            </section>
          </section>
        </section>

        <!-- Partenaire 4 -->
        <section class="card part">
          <section class="face face1">
            <section class="content parts">
              <img src="Images/behringer-logo.png" alt="Behringer-Logo">
            </section>
          </section>
          <section class="face face2">
            <section class="content parts">
              <p>Behringer Spezielle Studiotechnik GmbH (Behringer) est une société allemande d'électronique fondée en
                1989 et spécialisée dans le domaine de l'audio.</p> <br>
              <a target="_blank" href="https://www.behringer.com/Categories/Behringer/c/Behringer?q=:catRank:sectionision:CREA:publicProduct:true#googtrans">Plus
                d'infos</a>
            </section>
          </section>
        </section>
      </section>
    </section>
  </section>
  <?php include("Ext_footer.php"); ?>
  <?php include("Ext_script.php"); ?>

</body>

</html>