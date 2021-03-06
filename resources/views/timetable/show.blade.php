@extends('layout.logined')

@section('title')
    {{ __('timetable.show.title') }}
@endsection

@section('content')
    <div class="container">
        @foreach($days as $day)
            <div class="one-day">
                <h3>{{ __("days.".$day) }}</h3>
                <table class="timetable-table">
                    @foreach($lessons_by_day[$day] as $lesson)
                        <tr>
                            <td>
                                {{ $number($lesson) }}
                            </td>
                            @if ($show_group($lesson))
                                <td>
                                    {{ $show_group($lesson) }}
                                </td>
                            @endif
                            <td>
                                @if ($lesson->get_url())
                                    <a href="{{ $lesson->get_url() }}">
                                        {{ $lesson->get_title() }}
                                    </a>
                                @else
                                    {{ $lesson->get_title() }}
                                @endif
                            </td>
                            <td>
                                {{ $lesson->get_start()->format("H:i") }}
                            </td>
                            <td>
                                {{ $lesson->get_end()->format("H:i") }}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        @endforeach
    </div>
@endsection
