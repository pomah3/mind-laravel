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

    <form action="/documents" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="title" placeholder="title"><br>
        <input type="text" name="access" placeholder="access"><br>

        <input type="file" name="file"><br>

        <input type="submit">

    </form>

@endsection
