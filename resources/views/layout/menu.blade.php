<div class="container-menu">
<nav>
<ul class="main-menu">
    @foreach($menu_items as $item)
            @if (!$item['submenu'])
                 <li class="menu">
                    <a href="{{ $item['url'] }}">
                        {{ __($item["title"]) }}
                    </a>
                </li>
            @else
               <li class="menu-drop"><div class="btn-group">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        {{ __($item["title"]) }}
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        @foreach($item["buttons"] as $bitem)
                            <li class="not-list-style">
                                <a href="{{ $bitem['url'] }}">
                                    {{ __($bitem["title"]) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div></li>
            @endif
        </li>
    @endforeach
    <li class="right-menu menu-drop"><div class="btn-group">
        <a class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-cog" aria-hidden="true"></i>
            <span class="caret"></span>
        </a>
        <ul class="right-dropdown-menu dropdown-menu" role="menu">
            <li class="menu"><a href="/doc/user">{{ __("menu.info") }}</a></li>
            <li class="menu"><a href="/settings">{{ __("menu.settings") }}</a></li>
            <hr>
            <li class="menu"><a href="/out">{{ __("menu.logout") }}</a></li>
        </ul>
    </div></li>
</ul>
</nav>
</div>
