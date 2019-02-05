@extends("layout.main")

@section('title')
    {{ __("signin.title") }}
@endsection

@section("body")
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/signin" method="POST">
        @csrf
        <input required
            type="text"
            name="login"
            value="{{ old("login") }}"
        >
        <input required
            type="password"
            name="password"
        >
        <input type="submit">
    </form>

    <h1>Via edu tatar:</h1>
    <form action="/signin/edu" method="POST">
        @csrf
        <input required
            type="text"
            name="login"
            value="{{ old("login") }}"
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
