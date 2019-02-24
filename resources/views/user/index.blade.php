@extends('layout.logined')

@section('title')
    title
@endsection

@section('content')
	<div class="container container-points">
	    <ul>
	        @foreach ($users as $user)
	            <li class="not-list-style">
	                @user(["user" => $user])
	            </li>
	        @endforeach
	    </ul>
   </div>
@endsection
