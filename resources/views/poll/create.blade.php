@extends('layout.logined')

@section('title')
    {{ __('poll.create.title') }}
@endsection

@section('content')
	<div class="container container-points">
		<h2>{{ __('poll.create.title') }}</h2>

       @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

		<div class="voting_container">
		    <form action="/polls" method="POST" class="form-50">
		        @csrf

				<label for="title">{{ __('poll.create.poll-title') }}:</label>
				<input type="text" class="form-control" placeholder="{{ __('poll.create.placeholder.poll-title') }}" name="title" required>
		        <label for="content">{{ __('poll.create.description') }}:</label>
		        <input type="text" class="form-control" placeholder="{{ __('poll.create.placeholder.description') }}" name="content" required>
				<label for="date">{{ __('poll.create.date') }}:</label>
		        <input type="date" class="form-control" name="date" required>
		        <label class="variants-label">{{ __('poll.create.variants') }}:</label>
		        <div class="vars_container">
					<div class="vars">
						<div class="variant">
                            <input type="text" placeholder="{{ __('poll.create.placeholder.variants') }}" required class="variants wout-remove" name="variants[]">
                        </div>
                        <div class="variant">
                            <input type="text" placeholder="{{ __('poll.create.placeholder.variants') }}" required class="variants wout-remove" name="variants[]">
                        </div>
					</div>
					<div class="add-var">+ {{ __('poll.create.add-var') }}</div>
				</div>

                {{ __('poll.create.vote') }}: @access(["attr"=>"name=\"access_vote\""])
                {{ __('poll.create.see') }}: @access(["attr"=>"name=\"access_see_result\""])

		        <button type="submit" class="submit">{{ __('main.submit.send') }}</button>
		    </form>
		</div>
	</div>

    @push('scripts')
        <script>
            $(".add-var").click(function() {
                let el = $(
                    `<div class="variant">
                        <input type="text" placeholder="{{ __('poll.create.placeholder.variants') }}" required class="variants" name="variants[]">
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
