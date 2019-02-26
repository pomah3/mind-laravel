@php
    $par = explode('-', $group)[0];
@endphp

<div class="w-45 b-10 one-group {{ $par }}-par">
    <h2>Класс: <strong>{{ $group }}</strong></h2>
    <table class="table table-sm">
        @foreach($users as $user)
            <tr>
                <td class="pl-10">
                    @user(["user" => $user])
                </td>

                <td>
                    @can('set-status', $user)
                        <textarea class="status-set-area">{{ $user->status->title }}</textarea>
                        <button class="status-set-button" user-id="{{ $user->id }}">set</button>
                    @else
                        {{ $user->status->title }}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>
</div>
