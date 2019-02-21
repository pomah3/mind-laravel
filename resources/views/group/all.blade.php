@extends('layout.logined')

@section('title')
    Все группы
@endsection

@section('content')
	<div class="container">
		<div class="buttons">
			<div class="button-filter" id="all">Все классы</div>
			<div class="button-filter" id="6-par">6 классы</div>
			<div class="button-filter" id="7-par">7 классы</div>
			<div class="button-filter" id="8-par">8 классы</div>
			<div class="button-filter" id="9-par">9 классы</div>
			<div class="button-filter" id="10-par">10 классы</div>
			<div class="button-filter" id="11-par">11 классы</div>
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
        $('#6-par').on('click', function() { 
            $('.button-filter').hide();
            $('.6-par').show();
        });
        $('#7-par').on('click', function() { 
            $('.button-filter').hide();
            $('.7-par').show();
        });
        $('#8-par').on('click', function() { 
            $('.button-filter').hide();
            $('.8-par').show();
        });
        $('#9-par').on('click', function() { 
            $('.button-filter').hide();
            $('.9-par').show();
        });
        $('#10-par').on('click', function() { 
            $('.button-filter').hide();
            $('.10-par').show();
        });
        $('#11-par').on('click', function() { 
            $('.button-filter').hide();
            $('.11-par').show();
        });
        $('#all').on('click', function() { 
            $('.one-class').show();
        });
    </script>
@endpush
