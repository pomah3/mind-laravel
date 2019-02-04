<?php

namespace App\Http\Controllers;

use App\Poll;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->authorize('view_index', Poll::class);
        return view("poll.index", [
            "polls" => Poll::all()->filter(function($poll) {
                return Auth::user()->can("view", $poll);
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
        $this->authorize('create', Poll::class);
        return view("poll.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Poll::class);

        $poll = new Poll;
        $poll->creator_id = Auth::user()->id;
        $poll->title = $request->title;
        $poll->content = $request->content;

        $variants = $request->variants;
        $variants = explode(',', $variants);
        foreach ($variants as &$variant) {
            $variant = trim($variant);
        }

        $poll->variants = $variants;
        $poll->save();

        return redirect("/polls");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Poll  $poll
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function edit(Poll $poll)
    {
        $this->authorize('update', $poll);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poll $poll)
    {
        $this->authorize('update', $poll);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poll $poll)
    {
        $this->authorize('delete', $poll);
        $poll->votes()->delete();
        $poll->delete();
        return "";
    }
}
