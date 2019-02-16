@extends('layout.logined')

@section('title')
    Создать баннер
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

        <form action="/banners" method="POST" enctype="multipart/form-data" class="form-50">
            @csrf

            <label for="link">Ссылка на пост:</label>
            <input type="text" name="link" placeholder="Введите ссылку" class="form-control">
            <label for="alt">Замещающая запись:</label>
            <input type="text" name="alt" placeholder="Введите описание" class="form-control">
            <label for="from_date">Начало показа:</label>
            <input type="date" name="from_date" class="form-control">
            <label for="till_date">Конец показа:</label>
            <input type="date" name="till_date" class="form-control">

            <input type="file" name="img" class="form-control">

            <input type="submit" class="submit">

        </form>
    </div>

@endsection
