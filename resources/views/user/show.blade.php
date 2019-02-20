@extends('layout.logined')

@section('title')
    {{ $user->get_name() }}
@endsection

@section('content')
    {{ __("user.show.name") }}: {{ $user->get_name() }} <br>

    @can("view_password", $user)
        {{ __('user.show.login') }}: {{ $user->id }} <br>
        {{ __('user.show.password') }}: {{ $user->password }} <br>

        @if ($user->edu_tatar_login)
            Логин edu.tatar.ru: {{ $user->edu_tatar_login }} <br>
            Пароль edu.tatar.ru: {{ $user->edu_tatar_password }}
        @endif
    @endcan

    @can("delete", $user)
        <button class="delete-user" user-id="{{ $user->id }}">remove</button>
        @push('scripts')
            <script>
                $(".delete-user").click(function() {
                    let id = $(this).attr("user-id");

                    $.ajax({
                        method: "DELETE",
                        url: "/users/" + id
                    }).done(function() {
                        window.location = "/users";
                    });
                });
            </script>
        @endpush
    @endcan

@endsection
