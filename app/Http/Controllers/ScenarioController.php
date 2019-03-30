<?php

namespace App\Http\Controllers;

use App\Scenarios\ScenarioProvider;
use App\Scenarios\ScenarioRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScenarioController extends Controller {
	private $provider;
	private $repo;

	public function __construct(ScenarioProvider $provider, ScenarioRepository $repo) {
		$this->provider = $provider;
		$this->repo = $repo;
	}

    public function available() {
    	return view("scenario.available", [
    		"scenarios" => $this->provider->get_scenarios(Auth::user())
    	]);
    }

    public function mine() {
    	return view("scenario.mine", [
    		"scenarios" => $this->repo->get_all_of(Auth::user())
    	]);
    }

    public function create_index(Request $request) {
        $scenario = $this->provider->get_scenario($request->scenario);

    	return view("scenario.create", [
            "scenario" => $scenario
        ]);
    }

    public function create(Request $request) {
        $scenario = $this->provider->get_scenario($request->scenario);

        $input = $scenario->get_stages()["init"]->input;
        $input = collect($input)->map(function($in) use ($request) {
            $in->set_value($request);
            return $in;
        })->all();

        $scenario = $scenario->create(Auth::user(), $input);
        $this->repo->save($scenario);
        return redirect("/scenarios/create?scenario=".$scenario->get_name())->with("status", "ok");
    }

    public function show(Request $request, $id) {
        $scenario = $this->repo->get($id);
        return view("scenario.show", [
            "scenario" => $scenario
        ]);
    }

    public function answer(Request $request, $id) {
        $scenario = $this->repo->get($id);
        $input = $scenario->get_input();
        $input = collect($input)->map(function($in) use ($request) {
            $in->set_value($request);
            return $in;
        })->all();

        $scenario->handle(Auth::user(), $input);
        $this->repo->save($scenario);

        return redirect("/scenarios/mine");
    }
}
