@extends('layout.logined')

@section('title')
    {{ __('document.create.title') }}
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

            <label for="title">{{ __('document.create.form.title') }}</label>
            <input type="text" name="title" placeholder="{{ __('document.create.placeholder.title') }}" class="form-control" id="title">

            <label for="">{{ __('document.create.form.access') }}</label>: @access(["attr"=>"name=\"access\""])

            <input type="file" name="file" class="form-control" value="{{ __('main.submit.send') }}">
            <input type="submit" class="submit" value="{{ __('main.submit.send') }}">

        </form>
    </div>
@endsection
