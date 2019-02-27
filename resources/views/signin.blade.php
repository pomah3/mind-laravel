<!DOCTYPE html>
<html lang="{{ App::getLocale() }}" class="signin-html">
<head>
    <title>{{ __('signin.title') }}</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/img/favicon.ico">
    <link rel="stylesheet" href="{{ mix("css/lib.css") }}">
    <link rel="stylesheet" href="{{ mix("css/app.css") }}">

</head>
<body class="signin-body">

    <div class="signin-card">
        @if ($errors->any())
            <h5 class="mb2">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </h5>
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
            <div class="check hidden-lg">
                <input type="checkbox" class="form-check-input" name="is_edu">
                <label class="form-check-label" for="exampleCheck1">{{ __('signin.enter_edu_tatar') }}</label>
            </div>
            <input type="submit" class="submit" value="{{ __('signin.enter') }}">
            <div class="check hidden-sm">
                <input type="checkbox" class="form-check-input" name="is_edu">
                <label class="form-check-label" for="exampleCheck1">{{ __('signin.enter_edu_tatar') }}</label>
            </div>
        </form>
    </div>

    <script src="{{ URL::asset("js/app.js") }}"></script>
    @stack("scripts")

</body>
</html>
