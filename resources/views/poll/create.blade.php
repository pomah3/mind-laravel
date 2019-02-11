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
				<label for="date">Доступно до:</label>
		        <input type="date" class="form-control" placeholder="Введите описание голосования" name="date" required>
		        <label class="variants-label">Варианты ответов:</label>
		        <div class="vars_container">
					<div class="vars">
						<div class="variant">
                            <input type="text" placeholder="Введите вариант" required class="variants wout-remove" name="variants[]">
                        </div>
                        <div class="variant">
                            <input type="text" placeholder="Введите вариант" required class="variants wout-remove" name="variants[]">
                        </div>
					</div>
					<div class="add-var">+ Добавить вариант</div>
				</div>

		        <button type="submit" class="submit">Отправить</button>
		    </form>
		</div>
	</div>

    @push('scripts')
        <script>
            $(".add-var").click(function() {
                let el = $(
                    `<div class="variant">
                        <input type="text" placeholder="Введите вариант" required class="variants" name="variants[]">
                    </div>`
                );

                let but = $(`<div class="removalArea"><div class="removeX"></div></div>`);
                $(but).click(function() {
                    $(this.closest(".variant")).remove();
                });

                el.append(but);
                $(".vars").append(el);
            });
        </script>
    @endpush

@endsection
