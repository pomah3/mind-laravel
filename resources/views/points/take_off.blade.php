@extends('layout.logined')

@section('title')
    {{ __('group.all.title') }}
@endsection

@section('content')
    <div class="container container-points">
        @foreach ($groups as $group)
            <h1>{{ $group["group"] }}</h1>
            <table>
                @foreach ($group["users"] as $student)
                    <tr>
                        <td>
                            @user(["user" => $student])
                        </td>
                        <td>
                            {{ $student->student()->get_balance() }}
                        </td>
                        <td>
                            <input type="text" class="take-off-input">
                            <button student-id="{{ $student->id }}" class="take-off-button">Снять</button>
                        </td>
                    </tr>
                @endforeach
            </table>
        @endforeach
    </div>
@endsection

@push('scripts')
    <script>
        $(".take-off-button").click(function() {
            console.log("asd");
            let points = $(this).parent().find(".take-off-input").val();
            let student_id = $(this).attr("student-id");

            $.ajax({
                url: "/points/take_off",
                method: "POST",
                data: {
                    points, student_id
                }
            }).done(function() {
                location.reload();
            });
        });
    </script>
@endpush
