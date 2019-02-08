@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    {{ __("points.add.title") }}
@endsection

@section('content')
    <div class="container container-points">
        <h2>Баланс: <strong>300</strong> баллов</h2>

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

        <form action="/points/give" method="POST" class="form-50">
            @csrf

            <select required name="student_id" id="select-student" class="form-control"></select>
            <input required name="points" type="number" min="1" placeholder="Введите количество баллов" class="form-control">

            <input type="submit" class="submit">

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
    </div>
@endsection
