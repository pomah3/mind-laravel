@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    title
@endsection

@section('content')
    <form action="/banners" method="POST">
        @csrf

        <input type="text" name="img_path" placeholder="img_path"><br>
        <input type="text" name="link" placeholder="link"><br>
        <input type="text" name="alt" placeholder="alt">
        <input type="date" name="from_date" placeholder="from_date">
        <input type="date" name="till_date" placeholder="till_date">

        <input type="submit">

    </form>

@endsection
