@extends('layout.logined')

@section('title')
    Документы
@endsection

@section('content')
    @can('create', App\Document::class)
        <a href="/documents/create">создать</a>
    @endcan

    <ul>
        @foreach ($documents as $document)
            <li>
                <a href="/documents/{{ $document->id }}">
                    {{ $document->title }}
                </a>
                @can('update', $document)
                    (<a href="/documents/{{ $document->id }}/edit">edit</a>)
                @endcan
                @can('delete', $document)
                    <button class="remove-doc" doc-id="{{ $document->id }}">&times;</button>
                @endcan
            </li>
        @endforeach
    </ul>

    @push('scripts')
        <script>
            $(".remove-doc").click(function() {
                let that = this;
                let id = $(that).attr("doc-id");
                $.ajax({
                    "method": "DELETE",
                    "url": "/documents/" + id
                }).done(function() {
                    $(that).parent().remove();
                }).fail(function(err) {
                    console.log(err);
                });
            });
        </script>
    @endpush

@endsection
