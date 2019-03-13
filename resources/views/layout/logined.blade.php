
<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    <title>@yield('title')</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/img/favicon.ico">
    <link rel="stylesheet" href="{{ mix("css/lib.css") }}">
    <link rel="stylesheet" href="{{ mix("css/app.css") }}">
    <script>window.userId = null</script>
</head>
<body>

    <div class="main_container">
    <script>window.userId = {{ Auth::user()->id }}</script>

    <header>
        <div class="top-menu">
            <div class="container-menu">
                <img src="/img/logo_full.png" class="logo-img">
            </div>
        </div>

        @include('layout.banners')

        @include("layout.menu")

    </header>

    @yield('content')

        <script src="{{ URL::asset("js/app.js") }}"></script>
        @stack("scripts")

    </div>

</body>
</html>
