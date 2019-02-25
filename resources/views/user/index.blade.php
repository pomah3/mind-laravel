@extends('layout.logined')

@section('title')
    title
@endsection

@section('content')
	<div class="container container-points">
		<h2>Пользователи Mind</h2>
		<a href="/users/create" class="add-poll">+</a>
	    <ul>
	        @foreach ($users as $user)
	            <li class="not-list-style">
	                @user(["user" => $user])
	            </li>
	        @endforeach
	    </ul>
   </div>
@endsection
