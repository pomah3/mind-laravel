<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    <title>@yield('title')</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/img/favicon.ico">
    <link rel="stylesheet" href="{{ URL::asset("css/app.css") }}">

</head>
<body>

    @yield('body')

    <script src="{{ URL::asset("js/app.js") }}"></script>
    @stack("scripts")

</body>
</html>
