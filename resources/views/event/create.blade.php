@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    title
@endsection

@section('content')
    <div class="container container-points">
        <h2>Создать мероприятие</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/events" method="POST" enctype="multipart/form-data" class="form-50">
            @csrf

            <label for="title">Название мероприятия:</label>
            <input type="text" name="title" class="form-control" placeholder="Введите название">
            <label for="description">Описание мероприятия:</label>
            <input type="text" name="description" class="form-control" placeholder="Введите описание">
            <label for="from_date">Начало мероприятия:</label>
            <input type="date" name="from_date" class="form-control">
            <label for="title">Окончание мероприятия:</label>
            <input type="date" name="till_date" class="form-control">

            <div class="users-block">
                <label for="title">Участники:</label>
                <div class="add-user">+</div>
                <div class="variant">
                    <input type="text" name="users[]" class="variants" placeholder="Введите участника мероприятия">
                    <div class="removalArea"><div class="removeX"></div></div>
                </div>
            </div>


            <input type="submit" class="submit">

        </form>
    </div>
    @push('scripts')
        <script>
            $(".add-user").click(function() {
                $(".users-block").append(
                    `<div class="variant">
                        <input type="text" name="users[]" class="variants" placeholder="Введите участника мероприятия">
                        <div class="removalArea"><div class="removeX"></div></div>
                    </div>`
                );
                $(".removalArea").click(function() {
                    $(this).parent().remove();
                });
            });
            $(".removalArea").click(function() {
                $(this).parent().remove();
            });
        </script>
    @endpush

@endsection
