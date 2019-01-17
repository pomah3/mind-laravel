<?php

namespace App\Http\Controllers;

use App\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', Banner::class);
        return view("banner.show", ["banners" => Banner::orderBy("id", "desc")->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Banner::class);
        return view("banner.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Banner::class);

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        $this->authorize('update', Banner::class);
        return view('banner.edit', ["banner" => $banner]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $this->authorize('update', Banner::class);

        $banner->fill($request->except("_token"));
        $banner->save();

        return redirect("/banners");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $this->authorize('delete', Banner::class);

        Storage::disk("public")->delete("banners/".$banner->img_path);

        $banner->delete();

        return "";
    }
}
