
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
    <script>window.userId = {{ Auth::user()->id }}</script>
</head>
<body>
    <div class="main_container" id="app">

        <header>
            <div class="top-menu lang-set">
                <div class="top-menu-cont">
                    <img src="/img/logo_full.png" class="logo-img">
                    <div class="right-top-menu">
                        <div class="profile-thing">
                            <a href="/setlocale/ru">RU</a> |
                            <a href="/setlocale/tt">TT</a> |
                            <a href="/setlocale/en">EN</a>
                        </div>
                        {{-- <div class="btn-group">
                            <a class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-cog" aria-hidden="true"></i>
                                <span class="caret"></span>
                            </a>
                            <ul class="right-dropdown-menu dropdown-menu" role="menu">
                                <li class="menu"><a href="/doc/user">{{ __("menu.info") }}</a></li>
                                <li class="menu"><a href="/settings">{{ __("menu.settings") }}</a></li>
                                <hr>
                                <li class="menu"><a href="/logout">{{ __("menu.logout") }}</a></li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>

            @include('layout.banners')

            @include("layout.menu")

        </header>

        @yield('content')
        <div class="footer">
            <div class="left-footer">
                <a href="/doc" class="userlink">Справка</a><br>
                <p>Mind © 2018-{{ date('Y') }}</p>
            </div>
            <div class="right-footer">
                <a href="mailto:info@mind-itl-kfu.ru" class="userlink">info@mind-itl-kfu.ru</a><br>
                <a href="https://vk.com/mind_itl" class="userlink">Группа ВК</a>
            </div>
        </div>
    </div>

    <script src="{{ mix("js/app.js") }}"></script>

    <script>
        const app = new Vue({
            el: '#app',
            data: window.data || {}
        });
    </script>

    @stack("scripts")

</body>
</html>
