@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    title
@endsection

@section('content')
    <div class="container container-points">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/documents" method="POST" enctype="multipart/form-data" class="form-50">
            @csrf

            
            <input type="text" name="title" placeholder="title" class="form-control">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="access" id="exampleRadios1" value="option1" checked>
                    <label class="form-check-label" for="exampleRadios1">
                        Всем
                    </label>
            </div>
            <input type="radio" name="access" class="form-control" value='["all"]'>

            <input type="file" name="file" class="form-control">

            <input type="submit" class="submit">

        </form>
    </div>
@endsection
