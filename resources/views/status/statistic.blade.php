@extends('layout.logined')

@section('title')
    {{ __('status.statistic.title') }}
@endsection

@section('content')
    <div class="container">
        @foreach ($days as $day)
            <p>{{ $day["date"] }}</p>
            <table>
                @foreach ($day["statistics"] as $title => $count)
                    <tr>
                        <td>{{ $title }}</td>
                        <td>{{ $count }}</td>
                    </tr>
                @endforeach
            </table>
        @endforeach
    </div>
@endsection
