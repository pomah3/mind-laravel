@extends('layout.logined')

@section('title')
    {{ __('status.statistic.title') }}
@endsection

@section('content')
    <div class="container">
        <table>
            @foreach ($data as $key => $value)
                <tr>
                    <td>{{ __("status.types.$key") }}</td>
                    <td>{{ $value }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
