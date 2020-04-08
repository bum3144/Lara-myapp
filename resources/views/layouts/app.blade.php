<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token 자바스크립트 비동기 HTTP 요청때 사용-->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @yield('style')

    <!-- Scripts -->
    <script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
    </script>

</head>
<body>
    <div id="app">
    @include('layouts.partial.navigation')

    @if(session()->has('flash_message'))
        <div class="alert alert-info" role="alert">
            {{ session('flash_message') }}
        </div>
    @endif

        <main class="container">
            @include('flash::message')
            @yield('content')
        </main>

    @include('layouts.partial.footer')    
    </div>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    @yield('script')
</body>
</html>
