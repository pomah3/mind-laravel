@php
    $par = explode('-', $group)[0];
@endphp

<div class="b-10 group-status {{ $par }}-par">
    <h2>Класс: <strong>{{ $group }}</strong></h2>
    <table class="group-students">
        <tr>
            <td class="pl-10"><strong>Ученик</strong></td>
            @foreach ($status_r->get_all_statuses() as $s)
                <td><strong>{{ $s }}</strong></td>
            @endforeach
        </tr>
        @foreach($users as $user)
            <tr>
                <td class="pl-10 w-45">
                    @user(["user" => $user])
                </td>


                @foreach ($status_r->get_all_statuses() as $s)
                    @php
                        $has = $status_r->get_status($user)->title == $s;
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
