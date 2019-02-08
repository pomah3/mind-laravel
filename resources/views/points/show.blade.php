@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    {{ __("points.show.title") }}
@endsection

@section('content')
    <div class="container container-points">
        <h2>Баланс: <strong>{{ $student->student()->get_balance() }}</strong> баллов</h2>
        
        @foreach ($transactions as $tr)
            <div class="day">
                <h3 class="date">
                    
                </h3>
                <div class="transaction">
                    <div class="from-name">
                        
                        <span class="transaction-time">
                            {{ $tr->created_at }}
                        </span>
                    </div>
                    @if ($tr->points > 0)
                        <span class="points good-points">
                            +{{ $tr->points }}
                        </span>
                        <div class="cause">
                            {{ $tr->cause->title }}
                        </div>
                    @else
                        <span class="points bad-points">
                            {{ $tr->points }}
                        </span>
                        <div class="cause">
                            {{ $tr->cause->title }}
                        </div>
                    @endif
                </div>
            </div>
            {{-- <table>
                <tr>
                    <th>{{ __("points.show.time") }}</th>
                    <th>{{ __("points.show.points") }}</th>
                    <th>{{ __("points.show.from") }}</th>
                    <th>{{ __("points.show.to") }}</th>
                    <th>{{ __("points.show.cause") }}</th>
                </tr> --}}

              {{--   @foreach ($transactions as $tr)
                    <tr>
                        <td>{{ $tr->created_at }}</td>
                        <td>{{ $tr->points }}</td>
                        @if ($tr->from_user)
                            <td>@user(["user"=>$tr->from_user])</td>
                        @else
                            <td></td>
                        @endif
                        <td>@user(["user"=>$tr->to_user])</td>
                        <td>{{ $tr->cause->title }}</td>
                    </tr>
                @endforeach 
            </table>--}}
        @endforeach
    </div>
@endsection
