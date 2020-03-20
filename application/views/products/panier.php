<div class="container">


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

            </tbody>
        </table>
    </div>
    <div>
        <div>
            <div>
                <h5 class="titrepanier">TOTAL :  <sup>€</sup></h5>
                <a href="<?= site_url("panier/effacePanier"); ?>">Supprimer le panier</a> -
                <a href="<?= site_url("produits/liste"); ?>">Retour boutique</a>
            </div>
        </div>
    </div>
</div>


</div>

<script>
    $(document).ready(function() {
        var sub_panier = $('#sub-panier'); //Récupération de la div sous le thead du panier

        $.ajax({
            url: "<?= base_url('panier/vuePanier') ?>", // Appel du controller panier de la fonction vuePanier
            method: 'post',
            dataType: 'json',
            success: function(data) { // Si ça réussi, exécuter
                sub_panier.html('');
                $.each(data, function(index, value) { // Pour chaque valeur récupérées du tableau renvoyé par le controller
                    var prix = value[0]['produit_prix_HT'];
                    var qte = value[1];
                    var prixtot = prix * qte;
                    var total = parseInt(total) + parseInt(prixtot);
                    var child_sub = '<tr><td>' + value[0]["produit_nom"] + ' </td><td>' + value[0]['produit_prix_HT'] + '<sup>€</sup></td><td><div class="panier_qte"><div class="panier_qte_valeur"><i type="button" class="fas fa-minus-square"></i></a>' + value[1] + '<i type="button" class="fas fa-plus-square"></i></a></div></div></td><td>' + prixtot + ' <sup>€</sup></td><td><input name="idP" hidden="hidden" value=' + value[0]['produit_id'] + '><button type="submit" id="supprProd" name="supprProd"><i class="fas fa-trash-alt"></i></button></td></tr>';
                    sub_panier.append(child_sub); // child_sub = lignes du tableau injectées par append dans sub_panier


                    //console.log(total);
                }); // Ajout de la fonction supprimer, ailleurs cela ne fonctionne pas
                $('#supprProd').click(function() { // Appel au clique
                    var idP = $('input[name="idP"]').val();// Récupération de l'id par l'input
                    alert('wooow');// tests pour voir si la fonction s'éxecute
                    alert(idP);// tests
                    $.ajax({
                        url: "<?= base_url('panier/effaceProduit/') ?>",// Appel du controller panier, fonction effaceProduit
                        data: {
                            idP: idP // Passage de l'id dans la data du post
                        },
                        method: 'post',
                        dataType: 'json',
                    })
                    $.ajax({ // Fonction de base pour vérifier le nombre de produits dans le panier
                        url: "<?= base_url('panier/verifPanier') ?>",
                        method: 'post',
                        dataType: 'json',
                        success: function(value) {
                            var qtepanier = $('#qtepanier');
                            qtepanier.html('');
                            var qte = value;
                            qtepanier.append(qte);
                        }
                    })

                });
            }
        })
        
    });
</script>
