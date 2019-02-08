<!DOCTYPE html>
<html lang="{{ App::getLocale() }}" class="signin-html">
<head>
    <title>@yield('title')</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/img/favicon.ico">
    <link rel="stylesheet" href="{{ URL::asset("css/lib.css") }}">
    <link rel="stylesheet" href="{{ URL::asset("css/app.css") }}">

</head>
<body class="signin-body">

    <div class="signin-card">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/signin" method="POST">
            @csrf
            <div class="input-group form-group">
                <div class="input-group-prepend">
                    <i class="fa fa-user input-group-text" aria-hidden="true"></i>
                </div>
                <input required
                    type="text"
                    name="login"
                    class="form-control"
                    placeholder="Логин"
                    value="{{ old("login") }}"
                >
            </div>
            <div class="input-group form-group">
                <div class="input-group-prepend">
                    <i class="fa fa-lock input-group-text" aria-hidden="true"></i>
                </div>
                <input required
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Пароль"
                >
            </div>
            <input type="submit" class="submit" value="Войти">
            <div class="check">
                <input type="checkbox" class="form-check-input" name="is_edu">
                <label class="form-check-label" for="exampleCheck1">Вход через edu.tatar</label>
            </div>
        </form>
    </div>

    <script src="{{ URL::asset("js/app.js") }}"></script>
    @stack("scripts")

</body>
</html>
