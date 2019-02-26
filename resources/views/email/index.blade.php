@extends('layout.logined')

@section('title')
    Профиль
@endsection

@section('content')
	<div class="container container-points">
		<h2>Отправить письмо</h2>
	    <form action="/email/send" method="POST" class="form-50">
	        @csrf

	        <input type="text" name="title" placeholder="Тема" class="form-control">
	        <textarea name="text" class="form-control" placeholder="Сообщение"></textarea>
	        <label for="">Кто получит:</label>
	        @access(["attr"=>"name=\"access\""])

	        <input type="submit" class="submit">
	    </form>
	</div>
@endsection
