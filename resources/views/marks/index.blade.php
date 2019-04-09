@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    {{ __("marks.title") }}
@endsection

@section('content')
    <div class="container container-points container-marks">

        {{-- <table class="table table-sm">
            <tbody>
                <tr>
                    <td>
                        <strong>{{ __('marks.subject') }}</strong>
                    </td>
                    <td>
                        <strong>{{ __('marks.number') }}</strong>
                        <span id="mark_text">5</span>
                            <input type="text" id="mark" class="dis-none mark-change"></input>
                        <strong>{{ __('marks.for') }}</strong>
                        <span id="mid_text">4.50</span>
                            <input type="text" id="mid" class="dis-none mid-change">
                    </td>
                    <td><strong>{{ __('marks.middle') }}</strong></td>
                    <td colspan="100">
                        <strong>{{ __('marks.title') }}</strong>
                    </td>
                </tr> --}}

                <lessons-component v-bind:lessons="lessons">

{{--             </tbody>
        </table>
 --}}    </div>

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
