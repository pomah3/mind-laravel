@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    title
@endsection

@section('content')

    <div class="container container-points">
        <h2>Баннеры</h2>

        @can('create', App\Banner::class)
            <a href="/banners/create" class="add-banner">+</a>
        @endcan

        @forelse ($banners as $banner)
            @component("banner.banner", ["banner"=>$banner])
            @endcomponent
        @empty
            <div class="not-found">
                Нет загруженных баннеров
            </div>
        @endforelse

        @push("scripts")
        <script>
            $(".banner-delete").click(function() {
                let that = this;
                let id = $(that).attr("banner-id");

                $.ajax({
                    method: "DELETE",
                    url: "/banners/" + id,
                })
                .done(function() {
                    $(that).parent().parent().remove();
                });
            });
        </script>
        @endpush
    </div>

@endsection
