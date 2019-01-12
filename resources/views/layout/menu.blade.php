<div class="container-menu">
<nav>
<ul class="main-menu">
    @foreach($menu_items as $item)
            @if (!$item['submenu'])
                 <li>
                    <a href="{{ $item['url'] }}">
                        {{ __($item["title"]) }}
                    </a>
                </li>
            @else
               <li><div class="btn-group">
                    <a type="button" class="dropdown-toggle" data-toggle="dropdown">
                        {{ __($item["title"]) }}
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        @foreach($item["buttons"] as $bitem)
                            <a href="{{ $bitem['url'] }}">
                                {{ __($bitem["title"]) }}
                            </a>
                        @endforeach
                    </ul>
                </div></li>
            @endif
        </li>
    @endforeach
    <li class="right-menu"><div class="btn-group">
        <a type="button" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-cog" aria-hidden="true"></i>
            <span class="caret"></span>
        </a>
        <ul class="right-dropdown-menu dropdown-menu" role="menu">
            <li><a href="/info">{{ __("menu.info") }}</a></li>
            <li><a href="/settings">{{ __("menu.settings") }}</a></li>
            <hr>
            <li><a href="/out">{{ __("menu.logout") }}</a></li>
        </ul>
    </div></li>
</ul>
</nav>
</div>
