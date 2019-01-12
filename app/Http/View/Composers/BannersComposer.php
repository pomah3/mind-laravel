<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Banner;

class BannersComposer {
    public function compose(View $view) {
        $view->with("banners", Banner::all());
    }
}
