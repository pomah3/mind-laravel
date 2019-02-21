@extends('layout.logined')

@section('title')
    Все группы
@endsection

@section('content')
	<div class="container">
		<div class="buttons">
			<div class="button-filter" id="all">Все классы</div>
            @foreach ($pars as $par)
                <div class="button-filter" id="{{$par}}-par">{{$par}} классы</div>
            @endforeach
        </div>
        @foreach ($groups as $group)
            @component("group.table", [
                "users" => $group["users"],
                "balance" => $group["balance"],
                "group" => $group["group"]
            ])
            @endcomponent
        @endforeach
    </div>
@endsection

@push("scripts")
    <script>
        @foreach ($pars as $par)
            $('#{{$par}}-par').on('click', function() {
                $('.one-class').hide();
                $('.{{$par}}-par').show();
            });
        @endforeach
        $('#all').on('click', function() {
            $('.one-class').show();
        });
    </script>
@endpush
