<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @isset($title)
        <title>{{ $title }}</title>
    @else
        <title>{{ config('app.name', 'Laravel') }}</title>
    @endisset
    {{--<!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('fonts/font-awesome/css/font-awesome.min.css') }}" />
    <!-- CSS Files -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/now-ui-kit.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/plugins/owl.carousel.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/plugins/owl.theme.default.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" />
</head>
<body class="index-page sidebar-collapse">
    <div class="wrapper default">
        @yield('content')
        <footer class="mini-footer">
            <nav>
                <div class="container">
                    <ul class="menu">
                        <li>
                            <a href="#">درباره قالی خانه</a>
                        </li>

                        <li>
                            <a href="#">تماس با ما</a>
                        </li>


                    </ul>
                </div>
            </nav>
            <div class="copyright-bar">
                <div class="container">
                    <p>
                        استفاده از مطالب فروشگاه اینترنتی قالی خانه فقط برای مقاصد غیرتجاری و با ذکر منبع بلامانع است.
                        کلیه حقوق این سایت متعلق به
                        فروشگاه آنلاین قالی خانه می‌باشد.
                    </p>
                </div>
            </div>
        </footer>
    </div>
</body>
<!--   Core JS Files   -->
<script src="{{ asset('js/core/jquery.3.2.1.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/core/popper.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/core/bootstrap.min.js') }}" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="{{ asset('js/plugins/bootstrap-switch.js') }}"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="{{ asset('js/plugins/nouislider.min.js') }}" type="text/javascript"></script>
<!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
<script src="{{ asset('js/plugins/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<!-- Share Library etc -->
<script src="{{ asset('js/plugins/jquery.sharrre.js') }}" type="text/javascript"></script>
<!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('js/now-ui-kit.js') }}" type="text/javascript"></script>
<!--  CountDown -->
<script src="{{ asset('js/plugins/countdown.min.js') }}" type="text/javascript"></script>
<!--  Plugin for Sliders -->
<script src="{{ asset('js/plugins/owl.carousel.min.js') }}" type="text/javascript"></script>
<!--  Jquery easing -->
<script src="{{ asset('js/plugins/jquery.easing.1.3.min.js') }}" type="text/javascript"></script>
<!-- Main Js -->
<script src="{{ asset('js/main.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/lazyload.min.js') }}" type="text/javascript"></script>
<!--  Plugin ez-plus -->
<script src="{{ asset('js/plugins/jquery.ez-plus.js') }}" type="text/javascript"></script>
<script>
    function get_site_url() {
        return '{{ url('/') }}';
    }
</script>
</html>
