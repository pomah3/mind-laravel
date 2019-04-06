{{ $label }}: <select name="{{ $name }}">
    @foreach ($variants as $var)
        <option>{{ $var }}</option>
    @endforeach
</select>
