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

        <form action="/banners/{{$banner->id}}" method="POST" class="form-50">
            @csrf
            @method("PUT")

            <input type="text" name="link" value="{{ $banner->link }}" class="form-control">
            <input type="text" name="alt" value="{{ $banner->alt }}" class="form-control">
            <input type="date" name="from_date" value="{{ $banner->from_date->format("Y-m-d") }}" class="form-control">
            <input type="date" name="till_date" value="{{ $banner->till_date->format("Y-m-d") }}" class="form-control">

            <input type="submit" class="submit" value="Сохранить">

        </form>
        <div class="edit-img">
            <img src="{{ asset("storage/banners/".$banner->img_path) }}" alt="{{ $banner->alt }}">
        </div>
    </div>

@endsection
