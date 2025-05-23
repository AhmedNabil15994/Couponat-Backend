(function ($) {
    'use strict';

    /*======================================
     WOW Animation
     ======================================*/
    var wow = new WOW({
        boxClass: 'wow', // animated element css class (default is wow)
        animateClass: 'animated', // animation css class (default is animated)
        offset: 0, // distance to the element when triggering the animation (default is 0)
        mobile: false, // trigger animations on mobile devices (default is true)
        live: true, // act on asynchronously loaded content (default is true)
        callback: function (box) {},
        scrollContainer: true // optional scroll container selector, otherwise use window
    });
    wow.init();

    $('.home-slider').owlCarousel({
        responsiveClass: true,
        nav: false,
        dots: true,
        rtl: true,
        animateOut: 'fadeOut',
        autoplay: 3000,
        autoplayTimeout: 3000,
        smartSpeed: 3000,
        paginationSpeed: 3000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1200: {
                items: 1
            }
        }
    });

    $('.home-categories').owlCarousel({
        loop: true,
        responsiveClass: true,
        nav: false,
        dots: true,
        rtl: true,
        autoplay: true,
        margin: 20,
        navText: ['<span class="ti-angle-left"></span>', '<span class="ti-angle-right"></span>'],
        animateOut: 'fadeOut',
        smartSpeed: 300,
        paginationSpeed: 300,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 2
            },
            1200: {
                items: 7
            }
        }
    });

    $('.product-imgs').owlCarousel({
        loop: true,
        responsiveClass: true,
        nav: true,
        rtl: true,
        dots: true,
        autoplay: true,
        animateOut: 'fadeOut',
        navText: ['<span class="ti-angle-left"></span>', '<span class="ti-angle-right"></span>'],
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
                items: 1
            }
        }
    });



    /*======================================
     Preloader
     ======================================*/
    $('#preloader').fadeOut('slow', function () {
        $(this).remove();
    });

//    $('.sp-wrap').smoothproducts();
    $('#showPass').on('click', function () {
        var passInput = $("#passInput");
        if (passInput.attr('type') === 'password') {
            passInput.attr('type', 'text');
            $(this).addClass("active");
        } else {
            passInput.attr('type', 'password');
            $(this).removeClass("active");
        }
    });
    $('#showPass2').on('click', function () {
        var passInput = $("#passInput2");
        if (passInput.attr('type') === 'password') {
            passInput.attr('type', 'text');
            $(this).addClass("active");
        } else {
            passInput.attr('type', 'password');
            $(this).removeClass("active");
        }
    });
    // Single Accordean
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function () {
            /* Toggle between adding and removing the "active" class,
            to highlight the button that controls the panel */
            this.classList.toggle("active");

            /* Toggle between hiding and showing the active panel */
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        });
    }



//    $("#datepicker").datepicker({
//        minDate: 0
//    });
//    $('.selectpicker').selectpicker({
//        size: 6
//    });
//    $('.time-block').on('click', function (e) {
//        $('.time-block').not(this).removeClass('active');
//        $(this).toggleClass("active");
//    });
//    $('.pro-size .sizebtn').on('click', function (e) {
//        $('.pro-size .sizebtn').not(this).removeClass('active');
//        $(this).toggleClass("active");
//    });
//    $('.pro-color .sizebtn').on('click', function (e) {
//        $('.pro-color .sizebtn').not(this).removeClass('active');
//        $(this).toggleClass("active");
//    });
//    $('.search-categories .btn').on('click', function (e) {
//        $(this).toggleClass("active");
//    });
//
//    $(document).on('click', '.delivery-opt', function (e) {
//        e.preventDefault();
//        $('.delivery-modal').addClass('is-open');
//        $('#body-overlay').addClass('active');
//    });
//    $(document).on('click', '.pickup-opt', function (e) {
//        e.preventDefault();
//        $('.pickup-modal').addClass('is-open');
//        $('#body-overlay').addClass('active');
//    });
//    $(document).on('click', '.cart-btn', function (e) {
//        e.preventDefault();
//        $('.user-side-modal').addClass('is-open');
//        $('#body-overlay').addClass('active');
//    });
//    $(document).on('click', '.search-btn', function (e) {
//        e.preventDefault();
//        $('.search-modal').addClass('is-open');
//        $('#body-overlay').addClass('active');
//    });
//    $(document).on('click', '.side-menu', function (e) {
//        e.preventDefault();
//        $('.menu-modal').addClass('is-open');
//        $('#body-overlay').addClass('active');
//    });
//
//    $(document).on('click', '.close-modal, .confirm-btn', function (e) {
//        e.preventDefault();
//        $('.content-sidebar').removeClass('is-open');
//        $('.delivery-modal').removeClass('is-open');
//        $('.pickup-modal').removeClass('is-open');
//        $('#body-overlay').removeClass('active');
//    });
//    $(document).on('click', '.menu-responsive', function (e) {
//        e.preventDefault();
//        $('.main-menu').addClass('is-open');
//        $('#body-overlay').addClass('active');
//    });
//    $(document).on('click', '.close-modal', function (e) {
//        e.preventDefault();
//        $('.main-menu').removeClass('is-open');
//        $('#body-overlay').removeClass('active');
//    });
//    $(document).on('click', '.order-summery > h2', function (e) {
//        e.preventDefault();
//        $('.cart-summery-content').addClass('is-open');
//        $('#body-overlay').addClass('active');
//    });
//    $(document).on('click', '.close-modal', function (e) {
//        e.preventDefault();
//        $('.cart-summery-content').removeClass('is-open');
//        $('#body-overlay').removeClass('active');
//    });
//    $(document).on('click', '#body-overlay, .close-modal', function (e) {
//        e.preventDefault();
//        $('#body-overlay').removeClass('active');
//        $('.user-side-modal').removeClass('is-open');
//        $('.search-modal').removeClass('is-open');
//        $('.menu-modal').removeClass('is-open');
//        $('.main-menu').removeClass('is-open');
//        $('.cart-summery-content').removeClass('is-open');
//        $('.content-sidebar').removeClass('is-open');
//        $('.delivery-modal').removeClass('is-open');
//        $('.pickup-modal').removeClass('is-open');
//    });
//    $(document).on('click', '.quantity .plus, .quantity .minus', function (e) {
//        // Get values
//        var $qty = $(this).closest('.quantity').find('.qty'),
//            currentVal = parseFloat($qty.val()),
//            max = parseFloat($qty.attr('max')),
//            min = parseFloat($qty.attr('min')),
//            step = $qty.attr('step');
//        // Format values
//        if (!currentVal || currentVal === '' || currentVal === 'NaN')
//            currentVal = 0;
//        if (max === '' || max === 'NaN')
//            max = '';
//        if (min === '' || min === 'NaN')
//            min = 0;
//        if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN')
//            step = 1;
//        // Change the value
//        if ($(this).is('.plus')) {
//            if (max && (max == currentVal || currentVal > max)) {
//                $qty.val(max);
//            } else {
//                $qty.val(currentVal + parseFloat(step));
//            }
//        } else {
//            if (min && (min == currentVal || currentVal < min)) {
//                $qty.val(min);
//            } else if (currentVal > 0) {
//                $qty.val(currentVal - parseFloat(step));
//            }
//        }
//        // Trigger change event
//        $qty.trigger('change');
//        e.preventDefault();
//    });
//    $('.mySelect2').select2({
//        dropdownParent: $('#exampleModalLong')
//    });
//    $(".filter-active").on("click", function () {
//        $(a).addClass("active");
//    });
//    $(".choose-asap").on("click", function () {
//        $(".choose-time").removeClass("active");
//    });
//


    var $window = $(window);
    $window.on('scroll', function () {
        if ($window.scrollTop() > 0) {
            $('.categories-restraunt').addClass('sticky');
        } else {
            $('.categories-restraunt').removeClass('sticky');
        }
    });
    $('.print').on('click', function () {
        $.print(".order-details-content");
    });

    $(window).resize(function () {
        $('.img-block').each(function () {
            $(this).height($(this).width());
        });
    }).resize();
})(jQuery);