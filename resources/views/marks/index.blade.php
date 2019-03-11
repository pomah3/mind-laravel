@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    {{ __("marks.title") }}
@endsection

@section('content')
    <div class="container container-points">
        @if ($has_login)
            <table class="table table-sm">
                <tbody>
                    <tr>
                        <td>
                            <strong>Предмет</strong>
                        </td>
                        <td>
                            <strong>Количество</strong>
                            <span id="mark_text">5</span>
                                <input type="text" id="mark" class="dis-none mark-change"></input>
                            <strong>до</strong>
                            <span id="mid_text">4.50</span>
                                <input type="text" id="mid" class="dis-none mid-change">
                            <div class="help-block">
                                <div class="help">?</div>
                                <span class="tip">
                                    Кликни 2 раза на оценку и средний балл
                                </span>
                            </div>
                        </td>
                        <td colspan="100">
                            <strong>Оценки</strong>
                        </td>
                    </tr>
                    @foreach ($lessons as $lesson)
                        <tr>
                            <td class="w-40">{{ $lesson["name"] }}</td>
                            <td>{{ $lesson["need"] }}</td>
                            @foreach ($lesson["marks"] as $mark)
                                <td>{{ $mark }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            Сорри, у тебя нет логина еду татар
        @endif
    </div>

    @push('scripts')
        <script>
            $("#mid_text").dblclick(function () {
                let mid_text = $("#mid_text").html();
                $("#mid").val(mid_text);
                $("#mid_text").hide();
                $("#mid").show();
                $("#mid").focus();
            });
            $("#mid").focusout(function () {
                $("#mid").hide();
                let mid_text = $("#mid").val();
                $("#mid_text").html(mid_text);
                $("#mid_text").show();
            });
            $("#mark_text").dblclick(function () {
                let mid_text = $("#mark_text").html();
                $("#mark").val(mid_text);
                $("#mark_text").hide();
                $("#mark").show();
                $("#mark").focus();
            });
            $("#mark").focusout(function () {
                $("#mark").hide();
                let mid_text = $("#mark").val();
                $("#mark_text").html(mid_text);
                $("#mark_text").show();
            });
        </script>
    @endpush
@endsection
