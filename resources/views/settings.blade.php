@extends('layout.logined')

@section('title')
    {{ __("settings.title") }}
@endsection

@section('content')
    <div class="container">
        <div class="change">
            <h2>{{ __('settings.password') }}</h2>

            @if (isset($status))
                @if ($status == "wrong_password")
                    @alert(["type"=>"danger"])
                        Неправильный пароль!
                    @endalert
                @elseif ($status == "successful")
                    @alert(["type" => "success"])
                        Успешно!
                    @endalert
                @endif
            @endif

            @if ($errors->any())
                @alert(["type"=>"danger"])
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endalert
            @endif

            <form action="/settings/change_password" method="POST" class="form-80">
                @csrf

                <label for="old_password">{{ __('settings.old_password') }}:</label>
                <input type="password" id="old_password" name="old_password" class="form-control" placeholder="{{ __('settings.placeholder.old_password') }}">
                <label for="new_password">{{ __('settings.new_password') }}:</label>
                <input type="password" id="new_password" name="new_password" class="form-control" placeholder="{{ __('settings.placeholder.new_password') }}">
                <label for="new_password_confirmation">{{ __('settings.password_confirm') }}:</label>
                <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" placeholder="{{ __('settings.placeholder.password_confirm') }}">

                <input type="submit" class="submit" value="{{ __('main.submit.change_pass') }}">

            </form>
        </div>
        <div class="change">
            <h2>{{ __('settings.mail') }}</h2>

            <form action="/settings/change_email" method="POST" class="form-80">
                @csrf

                <label for="new_password">{{ __('settings.new_email') }}:</label>
                <input type="email" name="email" value="{{ Auth::user()->email }}" class="form-control" placeholder="{{ __('settings.placeholder.enter_mail') }}">

                <input type="submit" class="submit" value="{{ __('main.submit.change_email') }}">
            </form>
        </div>
    </div>
@endsection
