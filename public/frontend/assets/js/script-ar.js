/* ------------------------------------- */
/*   portfolio-filter
 /* ------------------------------------- */


// init Isotope
var $grid = $('.grid').isotope({
    isOriginLeft: false,
    itemSelector: '.grid-item',
    layoutMode: 'fitRows',

});

// bind filter button click
$('.filters-button-group').on('click', 'button', function () {
    var filterValue = $(this).attr('data-filter');
    // use filterFn if matches value
    // filterValue = filterFns[ filterValue ] || filterValue;
    $grid.isotope({
        filter: filterValue
    });
});
// change active class on buttons
$('.filters-button-group').each(function (i, buttonGroup) {
    var $buttonGroup = $(buttonGroup);
    $buttonGroup.on('click', 'button', function () {
        $buttonGroup.find('.active').removeClass('active');
        $(this).addClass('active');
    });
});
//$('.ctg-main').each(function (i, filterLink) {
//    var $filterLink = $(filterLink);
//    $filterLink.on('click', 'a', function () {
//        $filterLink.find('.active').removeClass('active');
//        $(this).addClass('active');
//    });
//});

$('.filter-active').owlCarousel({
    nav: true,
    loop: false,
    rtl: true,
    margin: 40,
    autoWidth: true,
    dots: false,
    responsive: {
        0: {
            items: 3
        },
        600: {
            items: 5
        },
        1000: {
            items: 15
        }
    }
});
    $('.product-like').owlCarousel({
        loop: true,
        responsiveClass: true,
        nav: true,
        rtl: true,
        dots: false,
        animateOut: 'fadeOut',
        autoplay: true,
        smartSpeed: 300,
        paginationSpeed: 300,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1200: {
                items: 3
            }
        }
    });
    $('.home-products').owlCarousel({
        loop: true,
        responsiveClass: true,
        nav: true,
        dots: false,
        rtl: true,
        animateOut: 'fadeOut',
        margin: 20,
        navText: false,
        autoplay: true,
        smartSpeed: 3000,
        paginationSpeed: 3000,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
             1200: {
                items: 0
            }
        }
    });
$('#cbox').on('click', function () {
    $('#cbox_info').toggle(900);
});
$('#cbox2').on('click', function () {
    $('#cbox_info2').toggle(900);
});
$('#cbox3').on('click', function () {
    $('#cbox_info3').toggle(900);
});
$('#cbox4').on('click', function () {
    $('#cbox_info4').toggle(900);
});
$('#cbox5').on('click', function () {
    $('#cbox_info5').toggle(900);
});

$('.image-gallery').magnificPopup({
    type: 'image',
    mainClass: 'mfp-with-zoom',
    gallery: {
        enabled: true
    },

    zoom: {
        enabled: true,

        duration: 300, // duration of the effect, in milliseconds
        easing: 'ease-in-out', // CSS transition easing function

        opener: function (openerElement) {

            return openerElement.is('img') ? openerElement : openerElement.find('img');
        }
    }

});

if(document.getElementById("map-frame")){
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map-frame'), {
            center: { lat: 24.501355, lng: 39.571912 },
            zoom: 18,
            styles: [{
                stylers: [{
                  saturation: -100
                }]
            }]
        });
    }
}

  $(document).on('click', '.quantity .plus, .quantity .minus', function (e) {
// Get values
      e.preventDefault();
      e.stopPropagation();
        var $qty = $(this).closest('.quantity').find('.qty'),
                currentVal = parseFloat($qty.val()),
                max = parseFloat($qty.attr('max')),
                min = parseFloat($qty.attr('min')),
                step = $qty.attr('step');
        // Format values
        if (!currentVal || currentVal === '' || currentVal === 'NaN')
            currentVal = 0;
        if (max === '' || max === 'NaN')
            max = '';
        if (min === '' || min === 'NaN')
            min = 0;
        if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN')
            step = 1;
        // Change the value
        if ($(this).is('.plus')) {
            if (max && (max == currentVal || currentVal > max)) {
                $qty.val(max);
            } else {
                $qty.val(currentVal + parseFloat(step));
            }
        } else {
            if (min && (min == currentVal || currentVal < min)) {
                $qty.val(min);
            } else if (currentVal > 0) {
                $qty.val(currentVal - parseFloat(step));
            }
        }
// Trigger change event
        $qty.trigger('change');
        e.preventDefault();
    });
