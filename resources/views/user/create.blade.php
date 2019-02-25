@extends('layout.logined')

@section('title')
    Create user
@endsection

@section('content')
    <div class="container container-points">
        <h2>Добавить пользователя</h2>
        <form action="/users/" method="POST" class="form-50">
            @csrf

            <input type="text" name="family_name" placeholder="Введите фиамилию" class="form-control">
            <input type="text" name="given_name"  placeholder="Введите имя" class="form-control">
            <input type="text" name="father_name" placeholder="Введите отчество" class="form-control">
            
            <label for="type"></label>
            <select class="type_select form-control" name="type" id="type">
                <option value="student">Ученик</option>
                <option value="teacher">Не ученик</option>
            </select>

            <input type="text" name="group" class="group form-control" placeholder="Введите класс обучения">
            <input type="submit" class="submit">
        </form>
    </div>
    @push('scripts')
        <script>
            $(".type_select").change(function() {
                if ($(".type_select").val() == "student")
                    $(".group").show();
                else
                    $(".group").hide();
            });
        </script>
    @endpush
@endsection


