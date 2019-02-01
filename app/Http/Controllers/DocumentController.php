<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller {

    public function index() {
        return view("document.index", [
            "documents" => Document::all()->filter(function($doc) {
                return Gate::allows("view", $doc);
            })
        ]);
    }

    public function create() {
        $this->authorize("create", Document::class);
        return view("document.create");
    }

    public function show(Document $document) {
        $this->authorize("view", $document);
        return response()->file(storage_path("app/documents/".$document->link));
    }

    public function store(Request $request) {
        $this->authorize("create", Document::class);

        $data = $request->validate([
            "title" => "required",
            "access" => "required|json",
            "file" => "required|mimes:docx,pdf,txt,md"
        ]);

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
            "documents", $doc->link
        );

        return redirect("/documents");
    }

    public function edit(Document $document) {
        $this->authorize("update", $document);
            return view("document.edit", [
            "document" => $document
        ]);
    }

    public function update(Request $request, Document $document) {
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

    public function destroy(Document $document) {
        $this->authorize("delete", $document);

        Storage::delete("documents/" . $document->link);

        $document->delete();
        return "";
    }
}
