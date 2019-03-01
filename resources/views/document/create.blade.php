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


            <input type="text" name="title" placeholder="title" class="form-control">

            Имеют доступ: @access(["attr"=>"name=\"access\""])

            <input type="file" name="file" class="form-control">
            <input type="submit" class="submit">

        </form>
    </div>
@endsection
