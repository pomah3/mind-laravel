@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    {{ __("points.give.title") }}
@endsection

@section('content')
    <div class="container container-points">
        <h2>{{ __('points.give.balance') }}: <strong>{{ Auth::user()->student()->get_balance() }}</strong> {{ trans_choice('group.table.points', Auth::user()->student()->get_balance()) }}</h2>

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

            <single-select
                :variants='@json($students)'
                name="students"
                placeholder="Начните вводить имя"
            ></single-select>

            <input required name="points" type="number" min="1" placeholder="{{ __('points.give.number') }}" class="form-control t-20">

            <input type="submit" class="submit" value="{{ __('main.submit.send') }}">

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
