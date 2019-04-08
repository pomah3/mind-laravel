@php
    $par = explode('-', $group)[0];
@endphp

<div class="w-45 b-10 one-group {{ $par }}-par">
    <h2>{{ __('group.table.group') }}: <strong>{{ $group }}</strong></h2>
    <h3>{{ __('group.table.balance') }}: <strong>{{ $balance }}</strong> {{ trans_choice('group.table.points', $balance) }}</h3>
    <table class="table table-sm">
        @foreach($users as $user)
            <tr>
                <td class="pl-10">
                    @user(["user" => $user])
                </td>

                <td>
                    {{ $user->student()->get_balance() }}
                </td>

                @can('see-points', $user)
                    <td>
                        <a href="/points/{{ $user->id }}" class="a-designed a-small">{{ __('main.link.more') }}</a>
                    </td>
                @endcan
            </tr>
        @endforeach
    </table>
</div>
