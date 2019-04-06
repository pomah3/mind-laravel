@extends('layout.logined')

@section('title')
    {{ __('email.index.title') }}
@endsection

@section('content')
	<div class="container container-points">
		<h2>{{ __('email.index.title') }}</h2>
	    <form action="/email/send" method="POST" class="form-50">
	        @csrf

	        <input type="text" name="title" placeholder="{{ __('email.form.title') }}" class="form-control">
	        <textarea name="text" class="form-control" placeholder="{{ __('email.form.text') }}"></textarea>
	        <label for="">{{ __('email.index.for') }}:</label>
	        @access(["attr"=>"name=\"access\""])

	        <input type="submit" class="submit" value="{{ __('main.submit.send') }}">
	    </form>
	</div>
@endsection
