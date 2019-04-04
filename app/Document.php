<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Document extends Model {
    protected $guarded = [
        "link"
    ];

    protected $casts = [
        "access" => "array"
    ];

    public function author() {
        return $this->belongsTo(User::class, "author_id");
    }

    public static function create(string $title, array $access, User $author) {
        $doc = new Document;
        $doc->title = $title;
        $doc->access = $access;
        $doc->author_id = $author->id;
        $doc->link = "";
        $doc->save();
        $doc->refresh();

        return $doc;
    }

    public function set_ext(string $ext) {
        $this->link = $this->id + ".$ext";
        $this->save();
    }
}
