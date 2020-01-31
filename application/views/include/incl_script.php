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
</div>