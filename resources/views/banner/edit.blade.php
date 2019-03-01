@extends('layout.logined')

@section('title')
    {{ __('banner.edit.title') }}
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

        <h2>{{ __('banner.edit.title') }}</h2>

        <div class="edit-img">
            <img src="{{ asset("storage/banners/".$banner->img_path) }}" alt="{{ $banner->alt }}">
        </div>

        <form action="/banners/{{$banner->id}}" method="POST" class="form-50">
            @csrf
            @method("PUT")

            <label for="link">{{ __('banner.info.link') }}:</label>
            <input type="text" name="link" value="{{ $banner->link }}" class="form-control">
            <label for="alt">{{ __('banner.info.alt') }}:</label>
            <input type="text" name="alt" value="{{ $banner->alt }}" class="form-control">
            <label for="from_date">{{ __('banner.info.from_date') }}:</label>
            <input type="date" name="from_date" value="{{ $banner->from_date->format("Y-m-d") }}" class="form-control">
            <label for="till_date">{{ __('banner.info.till_date') }}:</label>
            <input type="date" name="till_date" value="{{ $banner->till_date->format("Y-m-d") }}" class="form-control">

            <input type="submit" class="submit" value="{{ __('main.submit.save') }}">

        </form>
    </div>

@endsection
