@extends('layout.logined')

@section('title')
    title
@endsection

@section('content')
	<div class="container container-points">
		<h2>Создать голосование</h2>
		<div class="voting_container">
		    <form action="/polls" method="POST" class="form-50">
		        @csrf

				<label for="title">Заголовок голосования:</label>
				<input type="text" class="form-control" placeholder="Введите заголовок голосования" name="title" required>
		        <label for="content">Описание голосования:</label>
		        <input type="text" class="form-control" placeholder="Введите описание голосования" name="content" required>
		        <label class="variants-label">Варианты ответов:</label>
		        <div class="vars_container">
					<div class="vars">
						<div class="variant">
							<input type="text" placeholder="Введите вариант" required class="variants wout-remove">
						</div>
					</div>
					<div class="add-var">+ Добавить вариант</div>
				</div>

		        <button type="submit" class="submit">Отправить</button>
		    </form>
		</div>
	</div>
@endsection
