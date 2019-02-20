@extends('layout.logined')

@section('title')
    Timetable
@endsection

@section('content')
    <form action="/users/" method="POST">
        @csrf

        <input type="text" name="family_name" placeholder="фамилия">
        <input type="text" name="given_name"  placeholder="имя">
        <input type="text" name="father_name" placeholder="отчество">

        <select class="type_select" name="type">
            <option value="student">Ученик</option>
            <option value="teacher">Не ученик</option>
        </select>

        <input type="text" name="group" class="group">
        <input type="submit">
    </form>

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


