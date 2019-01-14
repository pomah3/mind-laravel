<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Question as Question_m;

class Question extends Controller
{
    public function show() {
        return view("question.show", [
            "questions" => Question_m::orderBy("created_at", "desc")->get()
        ]);
    }

    public function store(Request $request) {
        $text = $request->question;

        $question = new Question_m;
        $question->asker_id = Auth::user()->id;
        $question->question = $text;

        $question->save();

        return redirect("/questions");
    }

    public function delete(Question $question) {
        $question->delete();
        return "";
    }
}
