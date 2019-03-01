@extends('layout.logined')

@section('title')
    {{ __('group.get.title') }} {{ $group["group"] }}
@endsection

@section('content')
	<div class="container">
	    @component('group.table', [
	        "balance" => $group["balance"],
	        "group" => $group["group"],
	        "users" => $group["users"]
	    ])
	    @endcomponent
	</div>
@endsection
