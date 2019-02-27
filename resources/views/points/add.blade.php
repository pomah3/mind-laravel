@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    {{ __("points.add.title") }}
@endsection

@section('content')
    <div class="container container-points">
        <h2>Начислить баллы:</h2>
         @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('status'))
            @alert(["type"=>"success"])
                {{ session('status') }}
            @endalert
        @endif

        <form action="/points/add" method="POST" class="form-50">
            @csrf

            <select id="select-group" class="form-control"></select>
            <select required name="student_id" id="select-student" class="form-control"></select>
            <select id="select-category" class="form-control"></select>
            <select required name="cause_id" id="select-cause" class="form-control"></select>
            <input type="submit" class="submit">

        </form>
    </div>
    @push('scripts')
        <script>
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
        </script>
    @endpush

@endsection
