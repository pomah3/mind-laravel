@extends('layout.logined')

@section('title')
    {{ __('user.edit.title') }}
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

        <h2>Редактировать пользователя</h2>
        <form action="/users/{{ $user->id }}" method="POST" class="form-50">
            @csrf
            @method('PUT')

            <label for="family_name">Фамилия</label>
            <input
                type="text"
                name="family_name"
                id="family_name"
                placeholder="Введите фиамилию"
                class="form-control"
                value="{{ $user->family_name }}"
            >
            <label for="given_name">Имя</label>
            <input
                type="text"
                name="given_name"
                id="given_name"
                placeholder="Введите имя"
                class="form-control"
                value="{{ $user->given_name }}"
                >
            <label for="father_name">Отчество</label>
            <input
                type="text"
                name="father_name"
                id="father_name"
                placeholder="Введите отчество"
                class="form-control"
                value="{{ $user->father_name }}"
            >

            <label for="father_name">Пароль</label>
            <input
                type="text"
                name="password"
                id="father_name"
                placeholder="Введите отчество"
                class="form-control"
                value="{{ $user->password }}"
            >

            <input type="submit" class="submit" value="Сохранить">
        </form>
    </div>
@endsection


