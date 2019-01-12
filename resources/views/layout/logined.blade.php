@extends('layout.main')

@section('body')
    <header>
        <div class="top-menu">
            <div class="container-menu">
                <img src="/img/logo_animation.gif" alt="">
            </div>
        </div>

        @include('layout.banners')

        @include("layout.menu")

    </header>

    @yield('content')

@endsection
