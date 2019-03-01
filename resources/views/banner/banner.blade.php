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
        <div class="banner-label">{{ __('banner.info.link') }}: <a href="{{ $banner->link}}">{{ $banner->link}}</a> </div>
        <div class="banner-label">{{ __('banner.info.alt') }}: <span>{{ $banner->alt}}</span> </div>
        <div class="banner-label">{{ __('banner.info.from_date') }}: <span>{{ $banner->from_date}}</span> </div>
        <div class="banner-label">{{ __('banner.info.till_date') }}: <span>{{ $banner->till_date}}</span> </div>
    </div>

</div>
