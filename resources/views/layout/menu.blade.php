<ul>
    @foreach($menu_items as $item)
        <li>
            @if ($item['submenu'])
                <li>
                    @foreach($item["buttons"] as $bitem)
                        <a href="{{ $bitem['url'] }}">
                            {{ __($bitem["title"]) }}
                        </a>
                    @endforeach
                </li>
            @else
                <a href="{{ $item['url'] }}">
                    {{ __($item["title"]) }}
                </a>
            @endif
        </li>
        <li>
            <a href="/setlocale/ru">Русский</a>
        </li>
        <li>
            <a href="/setlocale/tt">Татарча</a>
        </li>
        <li>
            <a href="/setlocale/en">English</a>
        </li>
        <li>
            <a href="/out">{{ __("menu.out") }}</a>
        </li>
    @endforeach
</ul>
