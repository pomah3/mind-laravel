<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Question;

class QuestionController extends Controller
{
    public function show() {
        return view("question.show", [
            "questions" => Question::orderBy("created_at", "desc")->get()
        ]);
    }

    public function store(Request $request) {
        $text = $request->question;

        $question = new Question;
        $question->asker_id = Auth::user()->id;
        $question->question = $text;

        $question->save();

        return redirect("/questions");
    }

    public function delete(Question $question) {
        $question->delete();
        return "";
    }

    public function answer(Request $request, Question $question) {
        $question->answer = $request->answer;
        $question->answerer_id = Auth::user()->id;
        $question->answered_at = now();

        $question->save();
    }
}
