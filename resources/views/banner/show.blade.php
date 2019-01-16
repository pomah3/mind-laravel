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

@endsection
