    <!-- JQuery-->
    <script type="text/javascript" src="assets/js/jquery.slim.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>

    <script type="text/javascript" src="assets/js/jquery-ui.min.js"></script>

    <!-- Bootstrap -->
    <script type="text/javascript" src="assets/js/popper.min.js"></script>

    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <!-- Isotop -->
    <script type="text/javascript" src="assets/js/isotop.js"></script>
    <!-- Magnific Popup -->
    <script type="text/javascript" src="assets/js/magnific-popup.js"></script>
    <!-- owl.carousel -->
    <script type="text/javascript" src="assets/js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.parallax-scroll.js"></script>


    <!-- Main Custome Script -->
    <script type="text/javascript" src="assets/js/wow.min.js"></script>
    <script type="text/javascript" src="assets/js/select2.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-select.js"></script>
    <script type="text/javascript" src="assets/js/jquery.mCustomScrollbar.js"></script>
    <script type="text/javascript" src="assets/js/smoothproducts.min.js"></script>
    <script type="text/javascript" src="assets/js/date-picker.js"></script>
    <?php 
            if(isset($scripts) && count($scripts)){
                foreach($scripts as $script){
                    echo " <script src=\"assets/js/{$script}.js\"></script>";
                }
            }
        ?>
    <script type="text/javascript" src="assets/js/script-ar.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>

    <script>
        $('.product-like').owlCarousel({
        loop: true,
        responsiveClass: true,
        nav: true,
        dots: false,
        animateOut: 'fadeOut',
        autoplay: true,
        smartSpeed: 300,
        paginationSpeed: 300,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 1
            },
            768: {
                items: 1
            },
            992: {
                items: 2
            },
            1200: {
                items: 3
            }
        }
    });
    </script>
    <script>
        // Single Accordean
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
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
    </script>

    <script>
        const currentLoction = location.href;
        const menuItem = document.querySelectorAll('.ctg-main a');
        const menuLength = menuItem.length
        for (let i = 0; i < menuLength; i++) {
            if (menuItem[i].href === currentLoction) {
                menuItem[i].className = "active"
            }
        }
    </script>

    <script>
        const mobileLoction = location.href;
        const mobileNav = document.querySelectorAll('.mobile-nav li a');
        const mobileLength = mobileNav.length
        for (let i = 0; i < mobileLength; i++) {
            if (mobileNav[i].href === mobileLoction) {
                mobileNav[i].className = "active"
            }
        }
    </script>



    </body>

    </html>