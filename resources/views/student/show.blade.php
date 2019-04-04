@extends('layout.logined')

@section('title')
    {{ __("profile.title") }}
@endsection

@section('content')
    <div class="container">
        <table>
            <tr>
                <td>Фамилия</td>
                <td>Имя</td>
                <td>Отчество</td>
                <td>Класс</td>
                <td>Комната</td>
                <td>Этаж</td>
                <td>Телефон</td>
                <td>Email</td>
            </tr>

            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->family_name}}</td>
                    <td>{{ $student->given_name}}</td>
                    <td>{{ $student->father_name}}</td>
                    <td>{{ $student->studentInfo->group ?? "хз"}}</td>
                    <td>{{ $student->studentInfo->room ?? "хз" }}</td>
                    <td>{{ $student->studentInfo->level ?? "хз" }}</td>
                    <td>{{ $student->studentInfo->phone ?? "хз" }}</td>
                    <td>{{ $student->email ?? "хз" }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
