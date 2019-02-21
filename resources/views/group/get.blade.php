@extends('layout.logined')

@section('title')
    Группа {{ $group }}
@endsection

@section('content')
	<div class="container">
	    @component('group.table', [
	        "balance" => $balance,
	        "group" => $group,
	        "users" => $users
	    ])
	    @endcomponent
	</div>
@endsection
