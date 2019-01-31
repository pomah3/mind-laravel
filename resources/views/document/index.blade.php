@extends('layout.logined')

@php($user = Auth::user())

@section('title')
    title
@endsection

@section('content')
    @can('create', App\Document::class)
        <a href="/documents/create">создать</a>
    @endcan

    <ul>
        @foreach ($documents as $document)
            <li>
                <a href="{{asset("storage/documents/".$document->link)}}">
                    {{ $document->title }}
                </a>
            </li>
        @endforeach
    </ul>

@endsection
