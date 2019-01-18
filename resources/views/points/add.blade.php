@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    {{ __("points.add.title") }}
@endsection

@section('content')
    <h1>add points</h1>

    {{ $status }}

    <script>
        let students = @json($students);
    </script>

    <form action="/points/add" method="POST">
        @csrf

        <input type="text" name="student_id" placeholder="login"  required> <br>
        <input type="text" name="points"     placeholder="points" required> <br>
        <input type="submit">

    </form>
@endsection
