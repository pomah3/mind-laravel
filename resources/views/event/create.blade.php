@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    title
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/events" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="title"> <br>
        <input type="text" name="description"> <br>
        <input type="date" name="from_date"> <br>
        <input type="date" name="till_date"> <br>

        <div class="users-block">
            <div>
                <input type="text" name="users[]">
                <span class="delete-user">&times;</span>
            </div>
        </div>

        <div class="add-user">add</div>

        <input type="submit">

    </form>

    @push('scripts')
        <script>
            $(".add-user").click(function() {
                $(".users-block").append(
                    `<div>
                        <input type="text" name="users[]">
                        <span class="delete-user">&times;</span>
                    </div>`
                );
                $(".delete-user").click(function() {
                    $(this).parent().remove();
                });
            });
            $(".delete-user").click(function() {
                $(this).parent().remove();
            });
        </script>
    @endpush

@endsection
