@extends('layout.logined')

@section('title')
    Загрузить документ
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

        Имеют доступ: @access(["attr"=>"name=\"access\""])

        <input type="file" name="file"><br>

        <input type="submit">

    </form>

@endsection
