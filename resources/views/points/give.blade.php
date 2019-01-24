@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    {{ __("points.add.title") }}
@endsection

@section('content')
    <h1>give points</h1>

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

    <script>
        let students = @json($students);
    </script>

    <form action="/points/give" method="POST">
        @csrf

        <select required name="student_id" id="select-student"></select>
        <input required name="points" type="text" placeholder="баллы">

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
            })();
        </script>
    @endpush

@endsection
