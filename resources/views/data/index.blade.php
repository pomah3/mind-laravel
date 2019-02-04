@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    title
@endsection

@section('content')
    @if (session("status"))
        @if (session("status") == "ok")
            Success!
        @endif
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/data" method="POST" enctype="multipart/form-data">
        @csrf

        <select name="data-type" value="{{ old("data-type") }}">
            @foreach ($readers as $reader)
                <option value="{{ $reader->get_value() }}">{{ $reader->get_name() }}</option>
            @endforeach
        </select>

        <input type="file" name="file"><br>

        <input type="submit">

    </form>

@endsection
