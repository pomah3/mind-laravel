@extends('layout.logined')

@section('title')
    {{ __("profile.title") }}
@endsection

@section('content')
    <div class="container container-points">
        <a href="/students/excel?fields={{ $fields_raw }}" class="submit">Скачать</a>
        <table>
            <tr>
                @foreach ($fields as $field)
                    <td>{{ __('student.fields.'.$field) }}</td>
                @endforeach
            </tr>

            @foreach ($students as $student)
                <tr>
                    @foreach ($fields as $field)
                        <td>{{ $student[$field] }}</td>
                    @endforeach
                </tr>
            @endforeach
        </table>
    </div>
@endsection
