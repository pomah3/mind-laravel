<div class="one-banner">
    {{-- <div>id: {{ $banner->id}} </div> --}}
    <img src="{{ asset("storage/banners/".$banner->img_path) }}" alt="{{ $banner->alt }}">
    <div class="banner-buttons">
        @can("delete", $banner)
            <button class="banner-button banner-delete" banner-id="{{$banner->id}}">&times;</button>
        @endcan
        @can("update", $banner)
            <a href="/banners/{{$banner->id}}/edit" class="edit-banner banner-button">
                {{-- <i class="fa fa-pencil" aria-hidden="true"></i> --}}
                &#9998;
            </a>
        @endcan
    </div>
    <div class="banner-description">
        <div class="banner-label">Ссылка: <a href="{{ $banner->link}}">{{ $banner->link}}</a> </div>
        <div class="banner-label">Описание: <span>{{ $banner->alt}}</span> </div>
        <div class="banner-label">Начало показа: <span>{{ $banner->from_date}}</span> </div>
        <div class="banner-label">Конец показа: <span>{{ $banner->till_date}}</span> </div>
    </div>

</div>
