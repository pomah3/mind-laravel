<?php

namespace App\Http\Controllers;

use App\Poll;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class PollController extends Controller
{
    public function index()
    {
        // $this->authorize('view_index', Poll::class);
        return view("poll.index", [
            "polls" => Poll::orderBy("created_at", "desc")->get()->filter(function($poll) {
                return Auth::user()->can("view", $poll);
            })
        ]);
    }

    public function create()
    {
        $this->authorize('create', Poll::class);
        return view("poll.create");
    }

    public function store(Request $request)
    {
        $this->authorize('create', Poll::class);

        $data = $request->validate([
            "title"             => "required",
            "content"           => "required",
            "variants"          => "required|array",
            "date"              => "required|date",
            "access_vote"       => "required|json",
            "access_see_result" => "required|json",
            "can_revote"        => "required"
        ]);

        $poll = new Poll;
        $poll->creator_id = Auth::user()->id;
        $poll->title = $data["title"];
        $poll->content = $data["content"];
        $poll->till_date = $data["date"];
        $poll->can_revote = $data["can_revote"];

        $poll->access_vote = json_decode($data["access_vote"]);
        $poll->access_see_result = json_decode($data["access_see_result"]);

        $variants = $data["variants"];

        $poll->variants = $variants;
        $poll->save();

        return redirect("/polls");
    }

    public function show(Poll $poll)
    {
        $this->authorize('view', $poll);
        return view("poll.show", ["poll" => $poll]);
    }

    public function vote(Poll $poll, $var_id)
    {
        $this->authorize("vote", $poll);

        $var_id = intval($var_id);

        if (!isset($poll->variants[$var_id]))
            abort(404);

        $poll->vote(Auth::user(), $var_id);
        return "";
    }

    public function edit(Poll $poll)
    {
        $this->authorize('update', $poll);
    }

    public function update(Request $request, Poll $poll)
    {
        $this->authorize('update', $poll);
    }

    public function destroy(Poll $poll)
    {
        $this->authorize('delete', $poll);
        $poll->votes()->delete();
        $poll->delete();
        return "";
    }
}
