<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Excel\ReaderProvider;
use Illuminate\Support\Facades\Gate;

class DataController extends Controller {
    private $readers;

    public function __construct(ReaderProvider $readers) {
        $this->readers = $readers;
    }

    public function index() {
        $this->authorize("view-data");
        $readers = [];

        foreach ($this->readers->get_readers() as $reader) {
            if (Gate::allows("upload-data", $reader))
                $readers[] = $reader;
        }

        return view("data.index", [
            "readers" => $readers
        ]);
    }

    public function upload(Request $request) {
        $data = $request->validate([
            "file" => "required|mimes:xls,xlsx,zip",
            "data-type" => ["required", function($attribute, $value, $fail) {
                if (!$this->readers->has_reader($value))
                    $fail("$attribute is invalid");
            }]
        ]);

        $reader = $this->readers->get_reader($data["data-type"]);
        $request->authorize("upload-data", $reader);

        $reader->load($request->file("file")->getPathName());

        return redirect("/data")->with("status", "ok")->withInput();
    }
}
