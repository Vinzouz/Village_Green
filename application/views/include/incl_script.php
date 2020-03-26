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
<script>
    $(document).ready(function() {
        var sub_search = $('#sub-search');
        $('#searchbox').keyup(function() {
            var search_value = $('#searchbox').val();
            //alert(search_value);
            if (search_value != "") {
                $.ajax({
                    url: "<?= base_url('search/get_search') ?>",
                    data: {
                        search_value: search_value
                    },
                    method: 'post',
                    dataType: 'json',
                    success: function(data) {
                        //console.log(data);
                        sub_search.html('');
                        $.each(data, function(index, value) {
                            var child_search = '<div class="child-search"><a class="search" href="">' + value['produit_marque'] + ' ' + value['produit_nom'] + '</a></div>';
                            sub_search.append(child_search);
                        });
                    }
                })
            } else {
                sub_search.html('');
            }
        });
    });
</script>

<script>
        var qtepanier = $('#qtepanier');
        $('#ajoutP').click(function() {
            var pro_id = $('#pro_id').val();
            var pro_qte = $('#pro_qte').val();
            $.ajax({
                url: "<?= base_url('panier/ajoutPanier/') ?>",
                data: {
                    pro_qte: pro_qte,
                    pro_id: pro_id
                },
                method: 'post',
                dataType: 'json',
            })
            $.ajax({
                url: "<?= base_url('panier/verifPanier') ?>",
                method: 'post',
                dataType: 'json',
                success: function(value) {

                    qtepanier.html('');
                    var qte = value;
                    qtepanier.append(qte);
                }
            })
        });
</script>

<script>
        var qtepanier = $('#qtepanier');
        $.ajax({
            url: "<?= base_url('panier/verifPanier') ?>",
            method: 'post',
            dataType: 'json',
            success: function(value) {

                qtepanier.html('');
                var qte = value;
                qtepanier.append(qte);
            }
        })
</script>



</div>