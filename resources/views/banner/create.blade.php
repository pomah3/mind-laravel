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

        <form action="/banners" method="POST" enctype="multipart/form-data" class="form-50">
            @csrf

            <input type="text" name="link" placeholder="Введите ссылку" class="form-control">
            <input type="text" name="alt" placeholder="Введите описание" class="form-control">
            <input type="date" name="from_date" placeholder="from_date" class="form-control">
            <input type="date" name="till_date" placeholder="till_date" class="form-control">

            <input type="file" name="img" class="form-control">

            <input type="submit" class="submit">

        </form>
    </div>

@endsection
