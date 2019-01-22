@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    {{ __("points.add.title") }}
@endsection

@section('content')
    <h1>add points</h1>

    @if (session('status'))
        @alert(["type"=>"success"])
            {{ session('status') }}
        @endalert
    @endif

    <script>
        let students = @json($students);
        let causes = @json($causes);
    </script>

    <form action="/points/add" method="POST">
        @csrf

        <select required name="student_id" id="select-student"></select>
        <select required name="cause_id" id="select-cause"></select>
        <input type="submit">

    </form>

    @push('scripts')
        <script>
            (function() {
                const student_name = function(student) {
                    return `${student.family_name} ${student.given_name} ${student.father_name}, ${student.group}`;
                };

                students.forEach(function(student) {
                    $("#select-student").append(
                        `<option value="${student.id}">${student_name(student)}</option>`
                    );
                });

                causes.forEach(function(cause) {
                    let ct = cause.title + ' (' + (cause.points > 0 ? '+' : '') + cause.points + ')';

                    $("#select-cause").append(
                        `<option value="${cause.id}">${ct}</option>`
                    );
                });
            })();
        </script>
    @endpush

@endsection
