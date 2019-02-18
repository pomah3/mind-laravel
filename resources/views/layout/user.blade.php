@php
    $name = $user->type === "student" ? "fm gi" : "gi ft";
    $name = $user->get_name($name);
@endphp

<a class="userlink" href="/users/{{ $user->id }}">{{ $name }}</a>