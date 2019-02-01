<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("document.index", [
            "documents" => Document::all()->filter(function($doc) {
                return Gate::allows("view", $doc);
            })
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize("create", Document::class);
        return view("document.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize("create", Document::class);

        $data = $request->validate([
            "title" => "required",
            "access" => "required|json",
            "file" => "required|mimes:docx,pdf,txt,md"
        ]);

        // $doc = Document::create(collect($data)->except("file")->all());
        $doc = new Document;

        $doc->title = $data["title"];
        $doc->access = json_decode($data["access"]);
        $doc->link = "";
        $doc->author_id = Auth::user()->id;

        $doc->save();
        $doc->refresh();

        $ext = $request->file("file")->extension();
        $doc->link = $doc->id . ".$ext";

        $doc->save();

        $request->file('file')->storeAs(
            "documents", $doc->link, "public"
        );

        return redirect("/documents");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        $this->authorize("update", $document);
            return view("document.edit", [
            "document" => $document
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        $this->authorize("update", $document);

        $data = $request->validate([
            "title" => "required",
            "access" => "required|json",
        ]);

        $document->title = $data["title"];
        $document->access = json_decode($data["access"]);
        $document->save();
        return redirect("/documents");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        $this->authorize("delete", $document);

        Storage::disk("public")->delete("documents/" . $document->link);

        $document->delete();
        return "";
    }
}
