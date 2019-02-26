@php
    $par = explode('-', $group)[0];
@endphp

<div class="b-10 group-status {{ $par }}-par">
    <h2>Класс: <strong>{{ $group }}</strong></h2>
    <table class="group-students">
        <tr>
            <td><strong>Ученик</strong></td>
            <td><strong>П</strong></td>
            <td><strong>БД</strong></td>
            <td><strong>БИ</strong></td>
            <td><strong>УП</strong></td>
            <td><strong>В</strong></td>
        </tr>
        @foreach($users as $user)
            <tr>
                <td class="pl-10 w-45">
                    @user(["user" => $user])
                </td>

                <td>
                    @can('set-status', $user)
                        <button class="status-set-button status-set-hasnt" user-id="{{ $user->id }}">+</button>
                    @else
                        {{ $user->status->title }}
                    @endcan
                </td>
                <td>
                    @can('set-status', $user)
                        <button class="status-set-button status-set-hasnt" user-id="{{ $user->id }}">+</button>
                    @else
                        {{ $user->status->title }}
                    @endcan
                </td>
                <td>
                    @can('set-status', $user)
                        <button class="status-set-button status-set-hasnt" user-id="{{ $user->id }}">+</button>
                    @else
                        {{ $user->status->title }}
                    @endcan
                </td>
                <td>
                    @can('set-status', $user)
                        <button class="status-set-button status-set-hasnt" user-id="{{ $user->id }}">+</button>
                    @else
                        {{ $user->status->title }}
                    @endcan
                </td>
                <td>
                    @can('set-status', $user)
                        <button class="status-set-button status-set-hasnt" user-id="{{ $user->id }}">+</button>
                    @else
                        {{ $user->status->title }}
                    @endcan
                </td>

            </tr>
        @endforeach
    </table>
</div>
