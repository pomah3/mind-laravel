@extends('layout.logined')

@section('title')
    title
@endsection

@section('content')
    <form action="/polls" method="POST">
        @csrf

        <input type="text" name="title"   placeholder="title">
        <input type="text" name="content" placeholder="content">
        <input type="text" name="variants" placeholder="variants splitted by comma (,)">

        <input type="submit">
    </form>
@endsection
