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

<i class="fas fa-space-shuttle fa-rotate"></i>
<i class="fas fa-space-shuttle fa-rotate-90"></i><br>
<i class="fas fa-space-shuttle fa-rotate-270"></i>
<i class="fas fa-space-shuttle fa-rotate-180"></i>


@endsection
