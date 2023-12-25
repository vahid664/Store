<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @yield('faq')>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex,nofollow">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @isset($title)
        <title>{{ $title }}</title>
    @else
        <title>{{ config('app.name', 'Laravel') }}</title>
    @endisset
    <meta name="original-source" content="{{ urldecode(url()->current()) }}"/>
    <meta name="revisit-after" content="1 days">
    <meta name="language" content="fa"/>
    <meta name="document-type" content="Public"/>
    <meta name="document-rating" content="General"/>
    <meta name="resource-type" content="document"/>
    <meta property="business:contact_data:phone_number" content="+2144542991"/>
    <meta property="business:contact_data:website" content="{{ url('/') }}"/>
    <meta property="og:site_name" content="{{ config('app.name', 'Laravel') }}"/>
    <meta property="og:title" content="{{ isset($title) ? $title : config('app.name', 'Laravel') }}"/>
    <meta name="twitter:title" property="og:title" content="{{ isset($title) ? $title : config('app.name', 'Laravel') }}" />
    <meta property="og:type" content="website"/>
    @if(session('canonical'))
        <link rel="canonical" href="{{ str_replace('public','',url('/').'/'.session()->get('canonical')) }}" />
    @else
        <link rel="canonical" href="{{ str_replace('/public','',urldecode(url()->current())) }}" />
    @endif
	@if(session('panel'))
        <meta name="robots" content="noindex,nofollow">
    @endif
    @if(strpos( url()->current(), 'public' ) !== false)
        <meta name="robots" content="noindex,nofollow">
    @endif
    <meta property="og:brand" content="{{ config('app.name', 'Laravel') }}"/>
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:domain" content="{{ url('/') }}"/>
    @yield('img-seo')
    @if(!isset($query->id))
        <meta property="og:image" content="{{ asset('img/logo.png') }}"/>
        <meta property="og:image:width" content="250"/>
        <meta property="og:image:height" content="200"/>
        <meta property="og:image:alt" content="{{ config('app.name', 'Laravel') }}"/>
        <meta property="og:url" content="{{ url('/') }}"/>
        <meta name="twitter:image" content="{{ asset('img/logo.png') }}"/>
    @endif
    @if(isset($keywords))
        <meta property="og:description"
              content="{{ $description }}"/>
        <meta name="description"
              content="{{ $description }}"/>
        <meta name="keywords" content="{{ $keywords }}"/>
        <meta name="twitter:description" property="og:description" content="{{ $description }}" />
    @else
        @if(isset($query->keywords))
            <meta property="og:description" content="{{ $query->description }}"/>
            <meta name="description" content="{{ $query->description }}"/>
            <meta name="keywords" content="{{ $query->keywords }}"/>
            <meta name="twitter:description" property="og:description" content="{{ $query->description }}" />
            @if($query->tag_rel)
                @foreach($query->tag_rel as $val_tag)
                    <meta property="article:tag" content="{{ $val_tag->tag->title }}" />
                @endforeach
            @else
                @foreach(explode('،',$query->keywords) as $val)
                    <meta property="article:tag" content="{{ $val }}" />
                @endforeach
            @endif
        @endif
    @endif
    @yield('meta-next-prev')
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('img/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('img/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('img/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('img/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('img/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('img/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('img/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('img/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('img/favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#4f53f2">
    <meta name="msapplication-TileImage" content="{{ asset('img/favicon/ms-icon-144x144.png') }}">

    <meta name="theme-color" content="#4f53f2">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#4f53f2">
    <!-- iOS Safari -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="#4f53f2">
    <meta content="yes" name="apple-touch-fullscreen"/>
    <meta name="format-detection" content="telephone=no">
    <script type="application/ld+json">
     {
          "@context": "http://schema.org",
          "@type": "Organization",
          "url": "{{ url('/') }}",
          "logo": "{{ asset('img/logo.png') }}",
          "contactPoint": [{
            "@type": "ContactPoint",
            "telephone": "+2144542991",
            "contactType": "customer service"
          }]
     }
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Person",
      "name": "{{ config('app.name', 'Laravel') }}",
      "url": "{{ url('/') }}",
      "sameAs": [
        "https://www.instagram.com/"
      ]
    }
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "url": "{{ url('/') }}/",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "{{ url('/') }}/search?q={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }
    </script>
    @yield('json-ld')
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('fonts/font-awesome/css/font-awesome.min.css') }}" />
    <!-- CSS Files -->
    <link href="{{ asset('css/semantic.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/now-ui-kit.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/plugins/owl.carousel.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/plugins/owl.theme.default.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/botemnav.css') }}" rel="stylesheet" />
</head>
<body class="index-page sidebar-collapse">
@include('temp.navbar')
<!-- responsive-header -->
<!-- responsive-header -->
<div class="wrapper default">
    <!-- header -->
    @yield('top_banner')
    <header class="main-header default">
        @include('temp.top_menu')
        @include('temp.main_navbar')
    </header>
    <!-- header -->
    @yield('content')
    @include('temp.footer')
</div>
{{--<main class="py-4">
    @yield('content')
</main>--}}
@include('temp.modal_login')
<div class="modal-share modal fade" id="alert_message"
     tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
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
<script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/semantic.min.js') }}" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    function get_site_url() {
        return '{{ url('/') }}';
    }

    function imgChange(a)
    {
        $('#pic'+a).trigger('click');
    }

    $('.ui.search')
        .search({
            type          : 'category',
            minCharacters : 2,
            apiSettings   : {
                onResponse: function(githubResponse) {
                    var
                        response = {
                            results : {}
                        }
                    ;
                    $.each(githubResponse.items.brand.data, function(index, item) {
                        var
                            language   = item.language || 'Unknown',
                            maxResults = 2
                        ;
                        if(index >= maxResults) {
                            return false;
                        }
                        // create new language category
                        if(response.results[language] === undefined) {
                            response.results[language] = {
                                name    : language,
                                results : []
                            };
                        }
                        // add result to category
                        response.results[language].results.push({
                            title       : item.title,
                            description : item.title_en,
                            url         : item.link
                        });
                    });
                    $.each(githubResponse.items.category.data, function(index, item) {
                        var
                            language   = item.language || 'Unknown',
                            maxResults = 2
                        ;
                        if(index >= maxResults) {
                            return false;
                        }
                        // create new language category
                        if(response.results[language] === undefined) {
                            response.results[language] = {
                                name    : language,
                                results : []
                            };
                        }
                        // add result to category
                        response.results[language].results.push({
                            title       : item.title,
                            description : item.title_en,
                            url         : item.link
                        });
                    });
                    $.each(githubResponse.items.product.data, function(index, item) {
                        var
                            language   = item.language || 'Unknown',
                            maxResults = 10
                        ;
                        if(index >= maxResults) {
                            return false;
                        }
                        // create new language category
                        if(response.results[language] === undefined) {
                            response.results[language] = {
                                name    : language,
                                results : []
                            };
                        }
                        // add result to category
                        response.results[language].results.push({
                            title       : item.title,
                            description : item.title_en,
                            url         : item.link
                        });
                    });
                    return response;
                },
                url: '{{ route('JsonSearch.index').'?q={query}' }}'
            },
            error : {
                source      : 'مشکلی پیش آمده، ارتباط خود با اینترنت را چک کنید',
                noResults   : 'جستجوی شما نتیجه ای نداشت',
                logging     : 'خطا در ورود به سیستم اشکال زدایی ، خروج.',
                noTemplate  : 'الگوی مشخصی وارد نشده است',
                serverError : 'سرور در دسترس نمی باشد لطفا دقایقی دیگر دوباره امتحان کنید',
                maxResults  : 'حداکثر نتایج جستجو دارای مشکل می باشد',
                method      : 'مشکلی در سرور به وجود پیش آمده است.'
            }
        })
    ;
</script>
@yield('js')
</html>
