<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.5/jquery.bxslider.js"></script>
<script src="https://kit.fontawesome.com/2af6969b3e.js" crossorigin="anonymous"></script>
<script src=<?= base_url('assets/js/Script.js') ?>></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

<script type="text/javascript">
    window.onload = function() {
        $(".loader").hide();
        $('.allPage').css({
            visibility: "visible"
        });
    }


    $(document).ready(function($) {
        $('.card-slider').slick({
            dots: true,
            infinite: true,
            speed: 1000,
            slidesToShow: 2,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            arrows: false,
            responsive: [{
                breakpoint: 1100,
                settings: {
                    arrows: false,
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }]
        });
    });
</script>
<script> // Script jQuery pour la recherche dans la searchbar
    $(document).ready(function() { // Dès que la page est prête la fonction se charge
        var sub_search = $('#sub-search'); // Récupération de la div sous la searchbar pour faire apparaître les résultats (vide et invisible si aucune recherche)
        $('#searchbox').keyup(function() { // Déclenchement de la fonction à chaque lettre rentrée
            var search_value = $('#searchbox').val(); // Récupération de la valeur cherchée
            
            if (search_value != "") { // Si la valeur de recherche n'est pas nulle
                $.ajax({
                    url: "<?= base_url('search/get_search') ?>", // Appel de la fonction get_search du controller search
                    data: { // Mise en tableau de la valeur cherchée
                        search_value: search_value 
                    },
                    method: 'post', // Méthode POST
                    dataType: 'json', // Type de donnée json
                    success: function(data) { // Si réussi
                        
                        sub_search.html(''); // Remise à blanc de la recherche
                        $.each(data, function(index, value) { // Pour chaque résultat trouvé, affecter une div a child_search avec les valeurs
                            var child_search = '<div class="child-search"><a class="search" href="<?= base_url('ficheproduit/index/') ?>'+value['produit_id']+'">' + value['produit_marque'] + ' ' + value['produit_nom'] + '</a></div>';
                            sub_search.append(child_search); // Push des résulats dans la div sous la searchbar
                        });
                    }
                })
            } else { // Sinon si recherche vide (de base)
                sub_search.html(''); // Remise à blanc de la div sous la searchbar (donc invisible)
            }
        });
    });
</script>

<script> // Script jQuery pour ajouter un produit au panier
        var qtepanier = $('#qtepanier'); // Récupération de la quantité panier de la navbar
        $('#ajoutP').click(function() { // A chaque ajout de produit
            var pro_id = $('#pro_id').val(); // Récupération de l'id du produit
            var pro_qte = $('#pro_qte').val(); // Récupération de la quantité du produit
            $.ajax({ 
                url: "<?= base_url('panier/ajoutPanier/') ?>", // Appel de la fonction ajoutPanier du controller panier
                data: { // Mise en tableau de l'id du produit avec la quantité
                    pro_qte: pro_qte,
                    pro_id: pro_id
                },
                method: 'post', // Méthode POST
                dataType: 'json', // Type de donnée json
            })
            $.ajax({
                url: "<?= base_url('panier/verifPanier') ?>", // Appel de la fonction verifPanier du controller panier qui vérifie la quantité panier à chaque ajout
                method: 'post', // Méthode POST
                dataType: 'json', // Type de donnée json
                success: function(value) { // Si réussi

                    qtepanier.html(''); // Remise à blanc de la quantité
                    var qte = value; // Récup de la value de la fonction
                    qtepanier.append(qte); // Push de la quantité dans la balise récupérée en début
                }
            })
        });
</script>

<script> // Script jQuery pour mettre à jour la quantité panier 
        var qtepanier = $('#qtepanier'); // Récupération de la quantité panier de la navbar
        $.ajax({
            url: "<?= base_url('panier/verifPanier') ?>", // Appel de la fonction ajoutPanier du controller panier
            method: 'post', // Méthode POST
            dataType: 'json', // Type de donnée json
            success: function(value) { // Si réussi

                qtepanier.html(''); // Remise à blanc de la quantité
                var qte = value; // Récup de la value de la fonction
                qtepanier.append(qte); // Push de la quantité dans la balise récupérée en début
            }
        })
</script>

</div>