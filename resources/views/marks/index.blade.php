@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    {{ __("marks.title") }}
@endsection

@section('content')
    <div class="container container-points container-marks">
        <lessons-component v-bind:lessons="lessons">
    </div>

    @push('scripts')
        <script>
            data.lessons = [
                {
                    name: "Русский",
                    marks: [2,3,4,5]
                },{
                    name: "Математика",
                    marks: [2,3,4, 1]
                }
            ]
        </script>
    @endpush
@endsection
