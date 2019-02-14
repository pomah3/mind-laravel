<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Banner;
use Carbon\Carbon;

class BannersComposer {
    public function compose(View $view) {
        $view->with(
            "banners",
            Banner::where("from_date", "<=", Carbon::now())
                  ->where("till_date", ">=", Carbon::now())
                  ->get()
        );
    }
}
