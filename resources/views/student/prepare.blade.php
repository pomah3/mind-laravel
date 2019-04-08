@extends('layout.logined')

@section('title')
    {{ __("profile.title") }}
@endsection

@section('content')
    <div class="container">
        @foreach ($fields as $field)
            <input type="checkbox" class="fields" field-name="{{ $field }}"> {{ $field }} <br>
        @endforeach

        <a id="student-link" href="/students">Перейти</a>
    </div>

    @push('scripts')
        <script>
            $(".fields").change(function() {
                let url = "/students?fields=";
                $('input[type="checkbox"]').each(function() {
                    if ($(this).prop("checked")) {
                        console.log("asd");
                        url +=  $(this).attr('field-name') + ',';
                    }
                })

                $("#student-link").attr("href", url);
            });
        </script>
    @endpush
@endsection
