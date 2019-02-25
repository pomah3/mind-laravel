@php
    $par = explode('-', $group)[0];
@endphp

<div class="w-45 b-10 one-group {{ $par }}-par">
    <h2>Класс: <strong>{{ $group }}</strong></h2>
    <h3>Баланс: <strong>{{ $balance }}</strong> баллов</h3>
    <table class="table table-sm">
        @foreach($users as $user)
            <tr>
                <td class="pl-10">
                    @user(["user" => $user])
                </td>

                <td>
                    {{ $user->student()->get_balance() }}
                </td>

                <td>
                    <a href="/points/{{ $user->id }}" class="a-designed a-small">Подробнее</a>
                </td>
            </tr>
        @endforeach
    </table>
</div>
