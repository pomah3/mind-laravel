@extends('layout.logined')

@section('title')
    Загрузить данные
@endsection

@section('content')
    <div class="container container-points">
        @if (session("status"))
            @if (session("status") == "ok")
                Успешно!
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

        <form action="/data" method="POST" enctype="multipart/form-data" class="form-50">
            @csrf

            <select name="data-type" value="{{ old("data-type") }}" class="form-control">
                @foreach ($readers as $reader)
                    <option value="{{ $reader->get_name() }}">{{ $reader->get_title() }}</option>
                @endforeach
            </select>

            <input type="file" name="file" class="form-control">

            <input type="submit" class="submit">

        </form>
    </div>
@endsection
