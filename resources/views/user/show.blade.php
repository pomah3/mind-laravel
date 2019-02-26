@extends('layout.logined')

@section('title')
    {{ $user->get_name() }}
@endsection

@section('content')
    <div class="container container-points">
        <h2>{{ __("user.show.name") }}: {{ $user->get_name() }}</h2>
        
        @can("delete", $user)
            <button class="delete-user" user-id="{{ $user->id }}">&times;</button>
        @endcan

        @can("view_password", $user)
            <h3>{{ __('user.show.login') }}: <strong>{{ $user->id }}</strong></h3>
            <h3>{{ __('user.show.password') }}: <strong>{{ $user->password }}</strong></h3>

            @if ($user->edu_tatar_login)
                <h3>Логин edu.tatar.ru: <strong>{{ $user->edu_tatar_login }}</strong></h3>
                <h3>Пароль edu.tatar.ru: <strong>{{ $user->edu_tatar_password }}</strong></h3>
            @endif
        @endcan
    </div>
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
@endsection
