@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    title
@endsection

@section('content')
    <form action="/banners/{{$banner->id}}" method="POST">
        @csrf
        @method("PUT")

        <input type="text" name="link" value="{{ $banner->link }}"><br>
        <input type="text" name="alt" value="{{ $banner->alt }}">
        <input type="date" name="from_date" value="{{ $banner->from_date->format("Y-m-d") }}">
        <input type="date" name="till_date" value="{{ $banner->till_date->format("Y-m-d") }}">

        <input type="submit">

    </form>

@endsection
