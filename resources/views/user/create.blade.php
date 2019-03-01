@extends('layout.logined')

@section('title')
    {{ __('user.create.title') }}
@endsection

@section('content')
    <div class="container container-points">
        <h2>Добавить пользователя</h2>
        <form action="/users/" method="POST" class="form-50">
            @csrf

            <label for="family_name">Фамилия</label>
            <input type="text" name="family_name" id="family_name" placeholder="Введите фиамилию" class="form-control">
            <label for="given_name">Имя</label>
            <input type="text" name="given_name" id="given_name"  placeholder="Введите имя" class="form-control">
            <label for="father_name">Отчество</label>
            <input type="text" name="father_name" id="father_name" placeholder="Введите отчество" class="form-control">

            <label for="type">Роль пользователя</label>
            <select class="type_select form-control" name="type" id="type">
                <option value="student">Ученик</option>
                <option value="teacher">Не ученик</option>
            </select>
            <select class="role_select form-control" name="role" id="role" style="display: none;" multiple>
                <option value="predmet">Учитель-предметник</option>
                <option value="diric">Директор</option>
                <option value="zam">Заместитель директора</option>
                <option value="classruk">Классный руководитель</option>
                <option value="vospit">Воспитатель</option>
                <option value="socped">Социальный педагог</option>
                <option value="pedorg">Педагог-организатор</option>
                <option value="librarian">Библиотекарь</option>
                <option value="medic">Медицинский работник</option>
                <option value="moderator">Модератор</option>
            </select>


            <input type="text" name="group" class="group form-control" placeholder="Введите класс обучения">
            <input type="submit" class="submit">
        </form>
    </div>
    @push('scripts')
        <script>
            $(".type_select").change(function() {
                if ($(".type_select").val() == "student") {
                    $(".group").show();
                    $(".role_select").hide();
                }
                else {
                    $(".group").hide();
                    $(".role_select").show();
                }
            });
        </script>
    @endpush
@endsection


