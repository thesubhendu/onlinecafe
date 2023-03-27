<script>
    var owl = $('.owl-carousel');
    owl.owlCarousel({
        items: 2,
        loop: true,
        margin: 10,
        autoplay: false,
        autoplayTimeout: 2000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 1,
                nav: false
        },
        1000:{
            items:2,
            nav:true,
            loop:false
        }
    }
    });
    $('.play').on('click', function () {
        owl.trigger('play.owl.autoplay', [1000])
    })
    $('.stop').on('click', function () {
        owl.trigger('stop.owl.autoplay')
    })
</script>
<script>
    $(document).ready(function () {
        $('.owl-carousel').owlCarousel();
    });
</script>
