@extends('layout.logined')

@section('title')
    {{ __("profile.title") }}
@endsection

@section('content')
    <div class="container">
        <table>
            <tr>
                @foreach ($fields as $field)
                    <td>{{ $field }}</td>
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
