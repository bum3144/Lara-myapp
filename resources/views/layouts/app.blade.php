<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token 자바스크립트 비동기 HTTP 요청때 사용-->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

    @yield('style')

    <!-- Scripts -->
    <script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
    </script>

</head>
<body id="app-layout">
    <div id="app">
    @include('layouts.partial.navigation')

        <div class="container" id="app">
            @include('flash::message')

            @yield('content')
        </div>

    @include('layouts.partial.footer')    
    </div>

    <!-- Scripts -->
    <script src="{{ mix('/js/app.js') }}"></script>

    @yield('script')
</body>
</html>
