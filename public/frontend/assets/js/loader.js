(function($) {

    'use strict';


    // Cache jQuery Selector
    var $window = $(window);


    // Preloader For Hide loader
    function handlePreloader() {
        if ($('.preloader').length) {
            $('.preloader').delay(500).fadeOut(100);
        }
    }
    $window.on('load', function() {
        handlePreloader();
    });






})(jQuery);