@extends('layout.main')

@section('body')
    <header>
        <div class="top-menu">
            <div class="container-menu">
                <img src="/img/logo_full.png" width="200px">
            </div>
        </div>

        @include('layout.banners')

        @include("layout.menu")

    </header>

    @yield('content')

@endsection
