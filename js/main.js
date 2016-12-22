// -----------------------------------------------------------------------------
// Main Javascript
// -----------------------------------------------------------------------------
(function($) {
    "use strict";

    // Preloader
    // ----------------------------------------
    $(window).load(function(){
        if($('#preloader').length > 0){
            $('#preloader').fadeOut('slow',function(){$(this).remove();});
        }
    });


    // Animating the navbar toggle
    // ----------------------------------------
    $('.navbar-toggle').on('click', function () {
        $(this).toggleClass('active');
    });

    // Sliders
    // ----------------------------------------

    // home splash slider
    if($('.splash-slider').length > 0){ 
        $('.splash-slider').owlCarousel({
            singleItem: true,
            transitionStyle: 'fade',
            slideSpeed: 1000,
            autoPlay: 5000,
            mouseDrag: false,
            pagination: false,
            navigation: true,
            navigationText: ["<img src='img/arrow-left.png'>","<img src='img/arrow-right.png'>"]
        });
    }

    // simple gallery slider
    if($('.gallery-slider').length > 0){
        $('.gallery-slider').owlCarousel({
            singleItem: true,
            slideSpeed: 1000,
            autoPlay: 5000,
            mouseDrag: false,
            pagination: true
        });
    }

    // full width gallery slider
    if($('.full-gallery-slider').length > 0){
        $('.full-gallery-slider').owlCarousel({
            itemsDesktop: [1199,4],
            itemsDesktopSmall: [992,3],
            itemsTablet: [768,3],
            itemsMobile: [479,1],
            slideSpeed: 1000,
            autoPlay: 5000,
            pagination: false,
            navigation: true,
            navigationText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"]
        });
    }

    // testimonials slider
    if($('.testimonials-slider').length > 0){
        $('.testimonials-slider ').owlCarousel({
            singleItem: true,
            slideSpeed: 1000,
            autoPlay: 5000,
            mouseDrag: false,
            pagination: true
        });
    }

    // Portfolio Filtering
    // ----------------------------------------
    if($('.filter').length > 0){
        $(".filter").on("click", function () {
            var $this = $(this);
            // if we click the active tab, do nothing
            if ( !$this.hasClass("active") ) {
                $(".filter").removeClass("active");
                $this.addClass("active"); // set the active tab
                // get the data-rel value from selected tab and set as filter
                var $filter = $this.data("rel");
                // if we select view all, return to initial settings and show all
                $filter == 'all' ?
                    $(".item")
                    .css('opacity', 1)
                : // otherwise
                    $(".item")
                    .css('opacity', .2)
                    .filter(function () {
                        // set data-filter value as the data-rel value of selected tab
                        return $(this).data("filter") == $filter;
                    })
                    .css('opacity', 1);
            } // if
        });
    }

    // Gallery Popup
    // ----------------------------------------

    // image popup
    if($('.popup').length > 0){
        $('.popup').magnificPopup({
          type: 'image'
        });
    }

    // video popup
    if($('.popup-video').length > 0){
        $('.popup-video').magnificPopup({
            type: 'iframe'
        });
    }
    
})(jQuery);


