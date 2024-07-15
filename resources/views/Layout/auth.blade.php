<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.egenslab.com/html/scooby/preview/sign-up.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 08 Apr 2024 16:31:22 GMT -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scooby - {{$title}}</title>
    <link rel="icon" href="{{ asset('assets/images/sm-logo.svg') }}" type="image/gif" sizes="20x20">

    <link rel="stylesheet" href="{{ asset('assets/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/boxicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-icons.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/jquery.fancybox.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/odometer.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/datepicker.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/uiicss.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <style>
        .rotating {
            width:30px;height:30px;
            margin: 0 auto;
            text-align: center;
            border-radius: 50%;
            border: 2px dotted #ffffff;
            animation: rotate 2s linear infinite;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>

</head>

<body>

    <div class="top-bar">
        <div class="container-lg container-fluid ">
            <div class="row">
                <div class="col-lg-12 d-flex align-items-center justify-content-md-between justify-content-center">
                    <div class="social-area">
                        <ul>
                            <li><a href="https://www.facebook.com/"><i class="bx bxl-facebook"></i></a></li>
                            <li><a href="https://twitter.com/"><i class="bx bxl-twitter"></i></a></li>
                            <li><a href="https://www.pinterest.com/"><i class="bx bxl-pinterest-alt"></i></a></li>
                            <li><a href="https://www.instagram.com/"><i class="bx bxl-instagram"></i></a></li>
                        </ul>
                    </div>
                    <div class="opening-time text-center">
                        <p>Opening Hours<br><span>Mon - Sat 9.00 - 19.00</span></p>
                    </div>
                    <div class="contact-number">
                        <a href="tel:+1(541)754-3020">+1 (541) 754-3010 <img
                                src="{{ asset('assets/images/icon/support.svg') }}" alt></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <header class="header-area style-1"></header>
    @yield('content')

    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.timepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/aos.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.nice-select.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('assets/js/morphext.min.js') }}"></script>
    <script src="{{ asset('assets/js/odometer.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.marquee.min.js') }}"></script>
    <script src="{{ asset('assets/js/viewport.jquery.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/SmoothScroll.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.nice-number.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/masonry.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @yield('scripts')
</body>

</html>
