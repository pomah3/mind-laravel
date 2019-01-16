<div>
    <div>id: {{ $banner->id}} </div>
    <div>img_path: {{ asset("storage/banners/".$banner->img_path) }} </div>
    <div>link: {{ $banner->link}} </div>
    <div>alt: {{ $banner->alt}} </div>
    <div>from_date: {{ $banner->from_date}} </div>
    <div>till_date: {{ $banner->till_date}} </div>
</div>
