@php
    $par = explode('-', $group)[0];
    $statuses = [
        "П", "БД", "БИ", "УП", "В"
    ];
@endphp

<div class="b-10 group-status {{ $par }}-par">
    <h2>Класс: <strong>{{ $group }}</strong></h2>
    <table class="group-students">
        <tr>
            <td class="pl-10"><strong>Ученик</strong></td>
            @foreach ($statuses as $s)
                <td><strong>{{ $s }}</strong></td>
            @endforeach
        </tr>
        @foreach($users as $user)
            <tr>
                <td class="pl-10 w-45">
                    @user(["user" => $user])
                </td>

                @foreach ($statuses as $s)
                    @php
                        $has = $user->status->title == $s;
                    @endphp
                    <td>
                        @can('set-status', $user)
                            <button
                                class="status-set-button {{ $has ? "status-set-has" : "status-set-hasnt"}}"
                                user-id="{{ $user->id }}"
                                status="{{ $s }}"
                            >
                                {{ $has ? "+" : "-"}}
                            </button>
                        @else
                            {{ $has ? "+" : "-"}}
                        @endcan
                    </td>
                @endforeach
            </tr>
        @endforeach
    </table>
</div>
