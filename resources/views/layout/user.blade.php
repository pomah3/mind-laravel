<a class="userlink" href="/users/{{ $user->id }}">
    @if ($user->type === "student")
        {{ $user->get_name("fm gi") }}
    @else
        {{ $user->get_name("gi ft")}}
    @endif
</a>
