<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="images/fav.png" rel="shortcut icon">
    @yield('meta')
    <!--====== Google Font ======-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet">
    <!--====== Vendor Css ======-->
    <link rel="stylesheet" href="{{ url('frontend') }}/css/vendor.css">
    <!--====== Utility-Spacing ======-->
    <link rel="stylesheet" href="{{ url('frontend') }}/css/utility.min.css">
    <!--====== App ======-->
    <link rel="stylesheet" href="{{ url('frontend') }}/css/app.css">
     <!-- alertfy -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    @livewireStyles
</head>
<body class="config" id="js-scrollspy-trigger">
    <livewire:frontend.components.header>
    {{ $slot }}
    <livewire:frontend.components.footer>
    <!--====== Js ======-->
    <script src="{{ url('frontend') }}/js/vendor.js"></script>
    <script src="{{ url('frontend') }}/js/jquery.shopnav.js"></script>
    <script src="{{ url('frontend') }}/js/app.js"></script>
    <!-- AlertFy -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script>

        window.addEventListener('alert', (event) => {
            alertify.set('notifier','position', 'top-right');
            alertify.notify(event.detail.text, event.detail.type);
        });

    </script>
    @livewireScripts
    <script>
        var navigation2 = document.getElementById('navigation2');
        var btn_rhishi = document.getElementById('btn_rhishi');
        var navbarSupportedContent = document.getElementById('navbarSupportedContent');
        btn_rhishi.onclick = function(){
            navigation2.classList.toggle('js-open');
            navbarSupportedContent.classList.add('show');
        }
    </script>
    <script>
        $(".custom_alert").delay(4000).slideUp(200, function() {
            $(this).alert('close');
        });
    </script>
    <script>
        $(document).ready(function() {

        $("#slider-top").owlCarousel({

            navigation : true, // Show next and prev buttons

            slideSpeed : 300,
            paginationSpeed : 400,
            items : 1,
            itemsDesktop : false,
            itemsDesktopSmall : false,
            itemsTablet: false,
            itemsMobile : false,
            loop: true,
            autoplay: true,

        });

    });
    </script>

    <script>
        // When the user scrolls the page, execute myFunction
window.onscroll = function() {myFunction()};

// Get the navbar
var navbar = document.getElementById("fixed");

// Get the offset position of the navbar
var sticky = navbar.offsetTop;

// Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
    </script>
</body>
</html>
