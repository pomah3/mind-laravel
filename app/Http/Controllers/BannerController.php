<?php

namespace App\Http\Controllers;

use App\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller {
    public function index() {
        $this->authorize('view', Banner::class);
        return view("banner.show", ["banners" => Banner::orderBy("id", "desc")->get()]);
    }

    public function create() {
        $this->authorize('create', Banner::class);
        return view("banner.create");
    }

    public function store(Request $request) {
        $this->authorize('create', Banner::class);
        $request->validate([
            "link" => "required|url",
            "alt" => "required",
            "from_date" => "required|date",
            "till_date" => "required|date",
            "img" => "required|image"
        ]);

        $banner = new Banner;
        $banner->fill($request->except(["_token", "img"]));

        $ext = $request->file('img')->extension();

        if (!in_array($ext, ["jpg", "png", "gif", "jpeg"]))
            abort(403);

        $banner->img_path = "";

        $banner->save();
        $banner->refresh();

        $banner->img_path = $banner->id . ".$ext";
        $banner->save();

        $request->file('img')->storeAs(
            "banners", $banner->img_path, "public"
        );

        return redirect("/banners");
    }

    public function edit(Banner $banner) {
        $this->authorize('update', Banner::class);
        return view('banner.edit', ["banner" => $banner]);
    }

    public function update(Request $request, Banner $banner) {
        $this->authorize('update', Banner::class);

        $banner->fill($request->except("_token"));
        $banner->save();

        return redirect("/banners");
    }

    public function destroy(Banner $banner) {
        $this->authorize('delete', Banner::class);

        Storage::disk("public")->delete("banners/".$banner->img_path);

        $banner->delete();

        return "";
    }
}
