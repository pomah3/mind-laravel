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
                    <p class="placeholder">Выберите класс</p>
                </div>
            </div>
            <div class="one-selector dis-none">
                <h3>Категория</h3>
                <div class="wrapper" id="categories">
                </div>
            </div>
            <div class="one-selector dis-none">
                <h3>Основание</h3>
                <div class="wrapper" id="causes">
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
                let pars = @json($pars);
                let _groups = @json($groups);
                let _students = @json($students);
                let _causes = @json($causes);

                let causes = {};
                _causes.forEach(function(a) {
                    let cat = a.category;
                    causes[cat] = causes[cat] || [];
                    causes[cat].push(a);
                })
                let categories = Object.keys(causes);

                let groups = {};
                _groups.forEach(function(a) {
                    let [par, b] = a.split('-');
                    groups[par] = groups[par] || [];
                    groups[par].push(a);
                });

                let students = {};
                _students.forEach(function(a) {
                    let group = a.group;
                    students[group] = students[group] || [];
                    students[group].push(a);
                });

                const name = st => st.family_name + ' ' + st.given_name;

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
                        fill_students();
                    });
                }

                const fill_students = function() {
                    let group = $("#groups").find(".active-button").html().trim();
                    $("#students").empty();

                    students[group].forEach(function(a) {
                        $("#students").append(
                            `<div class="button-filter" student-id="${a.id}">${name(a)}</div>`
                        );
                    });
                    $("#students .button-filter").click(function() {
                        let name = $(this).html();

                        $("#pars").parent().hide();
                        $("#groups").parent().hide();
                        $("#students").parent().hide();
                        $("#categories").parent().show();
                        $("#causes").parent().show();
                        $("#selected_student").html(name);
                    });
                }

                const fill_categories = function() {
                    $("#categories").empty();
                    categories.forEach(function(a) {
                        $("#categories").append(
                            `<div class="button-filter">${a}</div>`
                        );
                    });

                    $("#categories .button-filter").click(function() {
                        $("#categories .button-filter").removeClass("active-button");
                        $(this).addClass("active-button");

                        fill_causes();
                    });
                }
                fill_categories();

                const fill_causes = function() {
                    let cat = $("#categories").find(".active-button").html().trim();
                    $("#causes").empty();
                    causes[cat].forEach(function(a) {
                        $("#causes").append(
                            `<div class="button-filter" cause_id="${a.id}">${a.title}</div>`
                        );
                    });
                }

                $("#pars .button-filter").click(function() {
                    $("#pars .button-filter").removeClass("active-button");
                    $(this).addClass("active-button");
                    fill_groups();
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
