@extends('layout.logined')

@section('title')
    {{ __('banner.create.title') }}
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

        <h2>{{ __('banner.create.title') }}</h2>

        <form action="/banners" method="POST" enctype="multipart/form-data" class="form-50">
            @csrf

            <label for="link">{{ __('banner.info.link') }}:</label>
            <input type="text" name="link" placeholder="{{ __('banner.info.placeholder.link') }}" class="form-control">
            <label for="alt">{{ __('banner.info.alt') }}:</label>
            <input type="text" name="alt" placeholder="{{ __('banner.info.placeholder.alt') }}" class="form-control">
            <label for="from_date">{{ __('banner.info.from_date') }}:</label>
            <input type="date" name="from_date" class="form-control">
            <label for="till_date">{{ __('banner.info.till_date') }}:</label>
            <input type="date" name="till_date" class="form-control">

            <input type="file" name="img" class="form-control">

            <input type="submit" class="submit" value="{{ __('main.submit.send') }}">

        </form>
    </div>

@endsection
