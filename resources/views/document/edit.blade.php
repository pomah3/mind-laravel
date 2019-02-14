@extends('layout.logined')

@section('title')
    Редактировать документ
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

    <form action="/documents/{{ $document->id }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <input type="text" name="title" placeholder="title" value="{{ $document->title }}"><br>
        <input type="text" name="access" placeholder="access" value="{{ json_encode($document->access) }}"><br>

        <input type="submit">

    </form>

@endsection
