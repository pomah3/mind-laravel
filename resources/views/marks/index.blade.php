@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    {{ __("marks.title") }}
@endsection

@section('content')
    <div class="container container-points container-marks">
        @if ($has_login)
            <lessons-component v-bind:lessons="lessons">
        @else
            Сорян, у тебя нет логина еду татара.
        @endif
    </div>

    @push('scripts')
        <script>
            data.lessons = @json($lessons);
        </script>
    @endpush
@endsection
