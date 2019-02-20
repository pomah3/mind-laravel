<div class="w-50 b-10 one-class {{-- вот сюда надо будет вставить --}}">
    <h2>Класс: <strong>{{ $group }}</strong></h2>
    <h3>Баланс: <strong>{{ $balance }}</strong> баллов</h3>
    <table class="table table-sm">
        @foreach($users as $user)
            <tr>
                <td>
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
