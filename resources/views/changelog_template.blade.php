# Changelog

@foreach ($versions as $version)
## {!! $version["name"] !!}

{!! $version["description"] !!}

@if (isset($version["news"][0]))
{!! $version["list_sentence"] !!}:

@foreach ($version["news"] as $new)
- {!! $new !!}
@endforeach

@else
### {!! $version["list_sentence"] !!}:

@foreach ($version["news"] as $title => $content)
#### {!! $title !!}

{!! $content !!}

@endforeach
@endif
@endforeach
