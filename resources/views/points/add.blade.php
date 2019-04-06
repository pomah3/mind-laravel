@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    {{ __("points.add.title") }}
@endsection

@section('content')
    <div class="container container-points">
        <h2>{{ __("points.add.title") }}</h2>
         @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h3 id="selected_student"></h3>
        <span class="edit-banner banner-button dis-none" id="edit_student">&#9998;</span>

        @if (session('status'))
            @alert(["type"=>"success"])
                {{ session('status') }}
            @endalert
        @endif

        <div class="selectors">
            <div class="one-selector">
                <h3>Параллель</h3>
                <div class="wrapper" id="pars">
                    @foreach ($pars as $par)
                        <div class="button-filter">{{ $par }}</div>
                    @endforeach
                </div>
            </div>
            <div class="one-selector">
                <h3>Класс</h3>
                <div class="wrapper" id="groups">
                    <p class="placeholder">Выберите параллель</p>
                </div>
            </div>
            <div class="one-selector">
                <h3>Ученик</h3>
                <div class="wrapper" id="students">
                    <div class="button-filter">Рома</div>
                    <div class="button-filter">Ринат</div>
                    <div class="button-filter">Данис</div>
                    <div class="button-filter">Наташа</div>
                    <div class="button-filter">Руслан</div>
                    <div class="button-filter">Тимур</div>
                    <p class="placeholder">Выберите класс</p>
                </div>
            </div>
            <div class="one-selector dis-none">
                <h3>Категория</h3>
                <div class="wrapper" id="categories">
                    <div class="button-filter">Олимпиадное движение</div>
                    <div class="button-filter">Проектная деятельность</div>
                    <div class="button-filter">Успеваемость</div>
                    <div class="button-filter">Культурно-масссовые мероприятия</div>
                    <div class="button-filter">Спортивные мероприятия</div>
                    <div class="button-filter">Внеурочная деятельность</div>
                    <div class="button-filter">Деятельность класса</div>
                    <div class="button-filter">Интернат</div>
                </div>
            </div>
            <div class="one-selector dis-none">
                <h3>Основание</h3>
                <div class="wrapper" id="causes">
                    <div class="button-filter">Машина межнара</div>
                    <div class="button-filter">Машина всероса</div>
                    <div class="button-filter">Машина респы</div>
                    <div class="button-filter">Мозг муниципа</div>
                    <div class="button-filter">Насасов школьного</div>
                    <div class="button-filter">Есть дневник олимпиадника</div>
                    <p class="placeholder">Выберите категорию</p>
                </div>
            </div>

        </div>
    </div>
    {{-- <form action="/points/add" method="POST" class="form-50">
        @csrf

        <select id="select-group" class="form-control"></select>
        <select required name="student_id" id="select-student" class="form-control"></select>
        <select id="select-category" class="form-control"></select>
        <select required name="cause_id" id="select-cause" class="form-control"></select>
        <input type="submit" class="submit">

    </form> --}}

    @push('scripts')
        <script>
            (function() {
                let _groups = @json($groups);
                let pars = @json($pars);

                let groups = {};
                _groups.forEach(function(a) {
                    let [par, b] = a.split('-');
                    groups[par] = groups[par] || [];
                    groups[par].push(a);
                });

                const fill_groups = function() {
                    let par = $("#pars").find(".active-button").html().trim();

                    $("#groups").empty();
                    groups[par].forEach(function(a) {
                        $("#groups").append(
                            `<div class="button-filter">${a}</div>`
                        );
                    });

                    $("#groups .button-filter").click(function() {
                        $("#groups .button-filter").removeClass("active-button");
                        $(this).addClass("active-button");
                    });
                }

                $("#pars .button-filter").click(function() {
                    $("#pars .button-filter").removeClass("active-button");
                    $(this).addClass("active-button");
                    fill_groups();
                });

                $("#students .button-filter").click(function() {
                    $("#pars").parent().hide();
                    $("#groups").parent().hide();
                    $("#students").parent().hide();
                    $("#categories").parent().show();
                    $("#causes").parent().show();
                    $("#selected_student").html("Пробная фамилия имя и отчество");
                });
            })();
        </script>
    @endpush

    @push('scripts')
        {{-- <script>
            (function() {
                let _causes = @json($causes);
                let _students = @json($students);

                let causes = {};
                _causes.forEach(function(a) {
                    causes[a.category] = causes[a.category] || [];
                    causes[a.category].push(a);
                });
                let categories = _causes.map(a=>a.category).unique();
                let groups = _students.map(a=>a.group).unique();

                students = {};
                _students.forEach(function(a) {
                    students[a.group] = students[a.group] || [];
                    students[a.group].push(a);
                });

                const student_name = function(student) {
                    return `${student.family_name} ${student.given_name} ${student.father_name}`;
                };

                groups.forEach(function(group) {
                    $("#select-group").append(
                        `<option>${group}</option>`
                    );
                });

                const fill_students = function() {
                    let v = $("#select-group").val();
                    $("#select-student").empty();

                    students[v].forEach(function(student) {
                        $("#select-student").append(
                            `<option value="${student.id}">${student_name(student)}</option>`
                        );
                    });
                }

                fill_students();
                $("#select-group").change(fill_students);

                categories.forEach(function(a) {
                    $("#select-category").append(
                        `<option>${a}</option>`
                    );
                });

                const fill_causes = function() {
                    let v = $("#select-category").val();
                    $("#select-cause").empty();
                    causes[v].forEach(function(cause) {
                        let ct = cause.title + ' (' + (cause.points > 0 ? '+' : '') + cause.points + ')';

                        $("#select-cause").append(
                            `<option value="${cause.id}">${ct}</option>`
                        );
                    });
                };

                fill_causes();
                $("#select-category").change(fill_causes);
            })();
        </script> --}}
    @endpush

@endsection
