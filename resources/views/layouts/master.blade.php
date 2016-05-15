<!DOCTYPE html>
<!--[if IE 9]>         <html class="ie9 no-focus"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-focus"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title>@yield('title', 'Helpsmile')</title>

        <meta name="description" content="OneUI - Admin Dashboard Template & UI Framework created by pixelcave and published on Themeforest">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
        @yield('meta')

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="{{ secure_secure_asset('assets/img/favicons/favicon.png') }}">

        <link rel="icon" type="image/png" href="{{ secure_secure_asset('assets/img/favicons/favicon-16x16.png') }}" sizes="16x16">
        <link rel="icon" type="image/png" href="{{ secure_secure_asset('assets/img/favicons/favicon-32x32.png') }}" sizes="32x32">
        <link rel="icon" type="image/png" href="{{ secure_secure_asset('assets/img/favicons/favicon-96x96.png') }}" sizes="96x96">
        <link rel="icon" type="image/png" href="{{ secure_secure_asset('assets/img/favicons/favicon-160x160.png') }}" sizes="160x160">
        <link rel="icon" type="image/png" href="{{ secure_secure_asset('assets/img/favicons/favicon-192x192.png') }}" sizes="192x192">

        <link rel="apple-touch-icon" sizes="57x57" href="{{ secure_secure_asset('assets/img/favicons/apple-touch-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ secure_secure_asset('assets/img/favicons/apple-touch-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ secure_secure_asset('assets/img/favicons/apple-touch-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ secure_secure_asset('assets/img/favicons/apple-touch-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ secure_secure_asset('assets/img/favicons/apple-touch-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ secure_secure_asset('assets/img/favicons/apple-touch-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ secure_secure_asset('assets/img/favicons/apple-touch-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ secure_secure_asset('assets/img/favicons/apple-touch-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ secure_secure_asset('assets/img/favicons/apple-touch-icon-180x180.png') }}">
        <!-- END Icons -->

        {!! Html::script('packages/trmix/dist/trmix.min.js', [], true) !!}

        @section('styles')
        <!-- Stylesheets -->
        <!-- Web fonts -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">

        <!-- Page JS Plugins CSS -->
        {!! Html::style('assets/js/plugins/slick/slick.min.css', [], true) !!}
        {!! Html::style('assets/js/plugins/slick/slick-theme.min.css', [], true) !!}

        <!-- Bootstrap and OneUI CSS framework -->
        {!! Html::style('assets/css/bootstrap.min.css', [], true) !!}
        {!! Html::style('assets/css/oneui.css',['id' => 'css-main'], [], true) !!}
        @show
        <!-- END Stylesheets -->
    </head>
    <body>
        @yield('content')

        @section('scripts')
        
        <!-- OneUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock, Appear, CountTo, Placeholder, Cookie and App.js -->
        {!! Html::script('assets/js/core/jquery.min.js', [], true) !!}
        {!! Html::script('assets/js/core/bootstrap.min.js', [], true) !!}
        {!! Html::script('assets/js/core/jquery.slimscroll.min.js', [], true) !!}
        {!! Html::script('assets/js/core/jquery.scrollLock.min.js', [], true) !!}
        {!! Html::script('assets/js/core/jquery.appear.min.js', [], true) !!}
        {!! Html::script('assets/js/core/jquery.countTo.min.js', [], true) !!}
        {!! Html::script('assets/js/core/jquery.placeholder.min.js', [], true) !!}
        {!! Html::script('assets/js/core/js.cookie.min.js', [], true) !!}
        {!! Html::script('assets/js/app.js', [], true) !!}

        <!-- Page Plugins -->
        {!! Html::script('assets/js/plugins/slick/slick.min.js', [], true) !!}

        <!-- Page JS Code -->
        
        <script>
            $(function () {
                // Init page helpers (Slick Slider plugin)
                App.initHelpers('slick');
            });
        </script>
        @show
    </body>
</html>