<div class="container-banner">
    <div id="rotator" class="banner-img">
        <ul>
            @foreach ($banners as $banner)
                <li>
                    <a href="{{ $banner->link }}">
                        <img src="{{ asset("banners/".$banner->img_path) }}" alt="{{ $banner->alt }}" class="banner">
                    </a>
                </li>
            @endforeach
            {{-- {% for ad in ads %}
                <li>
                    <a href="{{ ad.LINK }}">
                        <img src="{{ ad.IMG_PATH }}" alt="{{ ad.ALT }}" class="banner">
                    </a>
                </li>
            {% endfor %} --}}
        </ul>
    </div>
</div>
