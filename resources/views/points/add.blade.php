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

            <input type="text" class="form-control" placeholder="Начать поиск">
            <select required name="student_id" id="select-student" class="form-control"></select>
            <select required name="cause_id" id="select-cause" class="form-control"></select>
            <input type="submit" class="submit">

        </form>
    </div>
    @push('scripts')
        <script>
            var students = @json($students);
            var causes = @json($causes);
            console.log(students);
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
