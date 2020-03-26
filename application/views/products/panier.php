<div class="container">

    <?php if(isset($_SESSION["panier"])){
    $Panier = $_SESSION["panier"]; // Permet au foreach d'être initialisé
    $prixtotfinal = 0; // Initialisation de la variable hors du tableau pour éviter une boucle de reset et pouvoir afficher 0 en cas de panier vide. 
    }
    ?>
    <p>
        <h2 class="titrepanier">Votre panier :</h2>
    </p>
    <div class="table-responsive" id="tabpanier">
        <table class="table table-striped table-hover table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Produit</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Prix total</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody name="sub-panier" id="sub-panier">

            <?php 
            if (!empty($Panier))
            {
                foreach($Panier as $key) { 
                    $prixtot = $key[0]['produit_prix_HT'] * $key[1];  // Catch le prix x la quantité de chaque produit (pour le total par produit)
                    $prixtotfinal = $prixtotfinal + $prixtot; // calcul le prix final pour le total plus bas
                      ?>
      
                    <!-- Formulaire très important, qui permet d'envoyer vers le controler à chaque fois que le bouton supprimer apparait (a chaque fois qu'une ligne du panier est créée donc...) -->
                     <form action="effaceProduit" method="post">
      
                      <tr>
                              <td><?= $key[0]["produit_nom"] ?></td>
                              <td><?= $key[0]['produit_prix_HT'] ?><sup>€</sup></td>
                              <td>
                               <!-- Ce sont les liens qui amenent vers le controller et qui actualisent la page.  -->
                                   <div class="panier_qte">  
                                      <div class="panier_qte_valeur"><a href="qtemoins/<?=$key[0]['produit_id']?>"><i type="button" class="fas fa-minus-square"></i></a><?= $key[1] ?><a href="qteplus/<?=$key[0]['produit_id']?>"><i type="button" class="fas fa-plus-square"></i></a></div>
                                  </div>
                              </td>
                              <td><?= $prixtot ?><sup>€</sup></td>
                              <td><input name="idP" hidden="hidden" value="<?=$key[0]['produit_id']?>"><button type="submit" id="supprProd" name="supprProd"><i class="fas fa-trash-alt"></i></button></td>
                      </tr>
                      </form><?php
              
                } 
            }
            else 
            {
                print '<td colspan=5">Votre panier est vide.</td>'; // imprime une colspan 5 si le panier est vide.
            } ?>

            </tbody>
        </table>
    </div>
    <div>
        <div>
            <div>
                <h5 class="titrepanier">TOTAL : <?= $prixtotfinal ?> <sup>€</sup></h5>
                <a href="<?= site_url("panier/effacePanier"); ?>">Supprimer le panier</a> -
                <a href="<?= site_url("produits/liste"); ?>">Retour boutique</a>
            </div>
        </div>
    </div>
</div>


</div>