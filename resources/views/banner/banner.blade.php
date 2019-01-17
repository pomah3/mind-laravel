<div>
    <div>id: {{ $banner->id}} </div>
    <img src="{{ asset("storage/banners/".$banner->img_path) }}" alt="{{ $banner->alt }}">
    <div>link: {{ $banner->link}} </div>
    <div>alt: {{ $banner->alt}} </div>
    <div>from_date: {{ $banner->from_date}} </div>
    <div>till_date: {{ $banner->till_date}} </div>

    @can("update", $banner)
        <a href="/banners/{{$banner->id}}/edit">редачить</a>
    @endcan
    @can("delete", $banner)
        <button class="banner-delete" banner-id="{{$banner->id}}">удалити</button>
    @endcan
</div>
