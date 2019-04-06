<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>Mind</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/img/favicon.ico">
    <link rel="stylesheet" href="{{ mix("css/lib.css") }}">
    <link rel="stylesheet" href="{{ mix("css/app.css") }}">
</head>
<body>

    <div class="first-visit">
        <div class="container">
            <div class="jumbotron">
                {!! $text !!}
                <p class="lead">
                <a class="btn btn-primary btn-lg" href="/" role="button">Я согласен</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
