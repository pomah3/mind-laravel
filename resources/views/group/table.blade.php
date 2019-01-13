<div>
    Класс: {{ $group }}
    Баланс: {{ $balance }} баллов
</div>
<table>
    @foreach($users as $user)
        <tr>
            <td>
                {{ $user->get_name() }}
            </td>

            <td>
                {{ $user->student()->get_balance() }}
            </td>

            <td>
                <a href="/points/{{ $user->id }}">Подробнее</a>
            </td>
        </tr>
    @endforeach
</table>