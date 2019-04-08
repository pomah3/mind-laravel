@extends('layout.logined')

@section('title')
    {{ __('user.create.title') }}
@endsection

@section('content')
    <div class="container container-points">
        <h2>{{ __('user.create.title') }}</h2>
        <form action="/users" method="POST" class="form-50">
            @csrf

            <label for="family_name">{{ __('user.create.family_name') }}</label>
            <input type="text" name="family_name" id="family_name" placeholder="{{ __('user.create.placeholder.family_name') }}" class="form-control">
            <label for="given_name">{{ __('user.create.given_name') }}</label>
            <input type="text" name="given_name" id="given_name"  placeholder="{{ __('user.create.placeholder.given_name') }}" class="form-control">
            <label for="father_name">{{ __('user.create.father_name') }}</label>
            <input type="text" name="father_name" id="father_name" placeholder="{{ __('user.create.placeholder.father_name') }}" class="form-control">

            <label for="type">{{ __('user.create.type') }}</label>
            <select class="type_select form-control" name="type" id="type">
                <option value="student">{{ __('user.create.student') }}</option>
                <option value="teacher">{{ __('user.create.teacher') }}</option>
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


            <input type="text" name="group" class="group form-control" placeholder="{{ __('user.create.placeholder.group') }}">
            <input type="submit" class="submit" value="{{ __('main.submit.save') }}">
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


