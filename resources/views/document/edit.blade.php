@extends('layout.logined')

@section('title')
    {{ __('document.edit.title') }}
@endsection

@section('content')
    <div class="container container-points">
            <h2>{{ __('document.edit.title') }}</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/documents/{{ $document->id }}" method="POST" enctype="multipart/form-data" class="form-50">
            @method('PUT')
            @csrf

            <label for="title">{{ __('document.edit.title') }}</label>
            <input type="text" id="title" name="title" class="form-control" placeholder="{{ __('document.edit.placeholder.title') }}" value="{{ $document->title }}">
            <label for="title">{{ __('document.edit.access') }}</label>
            <input type="text" id="access" name="access" class="form-control" placeholder="{{ __('document.edit.placeholder.access') }}" value="{{ json_encode($document->access) }}">

            <input type="submit" class="submit" value="{{ __('main.submit.send') }}">

        </form>
    </div>

@endsection
