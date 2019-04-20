<div class="container-banner">
    <div id="rotator" class="banner-img">
        <ul>
            @foreach ($banners as $banner)
                <li>
                    <a href="{{ $banner->link }}" target="_blank">
                        <img src="{{ asset("storage/banners/".$banner->img_path) }}" alt="{{ $banner->alt }}" class="banner">
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
