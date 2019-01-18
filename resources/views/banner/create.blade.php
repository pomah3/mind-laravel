@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    title
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/banners" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="link" placeholder="link"><br>
        <input type="text" name="alt" placeholder="alt">
        <input type="date" name="from_date" placeholder="from_date">
        <input type="date" name="till_date" placeholder="till_date">

        <input type="file" name="img">

        <input type="submit">

    </form>

@endsection
