<ul>
    @foreach($menu_items as $item)
            @if ($item['submenu'])
                <li>
                    @foreach($item["buttons"] as $bitem)
                        <a href="{{ $bitem['url'] }}">
                            {{ __($bitem["title"]) }}
                        </a>
                    @endforeach
                </li>
            @else
                <li>
                    <a href="{{ $item['url'] }}">
                        {{ __($item["title"]) }}
                    </a>
                </li>
            @endif
        </li>
        <li>
            <a href="/out">{{ __("menu.out") }}</a>
        </li>
    @endforeach
</ul>
