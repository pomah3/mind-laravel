@extends('layout.logined')

@section('title')
    {{ __("profile.title") }}
@endsection

@section('content')
    <div class="container container-points">
        @foreach ($fields as $field)
            <div class="form-control">
                <input type="checkbox" class="fields" field-name="{{ $field }}">
                {{ __('student.fields.'.$field) }}
            </div>
        @endforeach

        <a id="student-link" href="/students" class="submit">Перейти</a>
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
