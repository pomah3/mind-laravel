<a class="userlink" href="/user/{{ $user->id }}">
    @if ($user->type === "student")
        {{ $user->get_name("fm gi") }}
    @else
        {{ $user->get_name("gi ft")}}
    @endif
</a>
