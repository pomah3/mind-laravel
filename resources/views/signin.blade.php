@extends("layout.main")

@section('title')
    {{ __("signin.title") }}
@endsection

@section("body")
    @if (isset($status))
        @alert(["type"=>"danger"])
            {{ __("signin.status.".$status) }}
        @endalert
    @endif

    <form action="" method="POST">
        @csrf
        <input required
            type="text"
            name="login"
            value="{{ $login ?? "" }}"
        >
        <input required
            type="password"
            name="password"
        >
        <input type="submit">
    </form>

@endsection
