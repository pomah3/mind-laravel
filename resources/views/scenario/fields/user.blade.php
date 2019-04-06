{{ $label }}: <select name="{{ $name }}">
    @foreach ($users as $user)
        <option value="{{ $user->id }}">{{ $user->get_name() }}</option>
    @endforeach
</select>
