@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    title
@endsection

@section('content')
    @can('create', App\Banner::class)
        <a href="/banners/create">создать</a>
    @endcan

    @foreach ($banners as $banner)
        @component("banner.banner", ["banner"=>$banner])
        @endcomponent
    @endforeach

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
                $(that).parent().remove();
            });
        });
    </script>
    @endpush

@endsection
