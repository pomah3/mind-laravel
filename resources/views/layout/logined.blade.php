@extends('layout.main')

@section('body')
    <script>window.userId = {{ Auth::user()->id }}</script>

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
