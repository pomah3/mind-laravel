<?php

namespace App\Http\Controllers;

use App\Scenarios\ScenarioProvider;
use App\Scenarios\ScenarioRepository;
use Illuminate\Http\Request;

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

    public function create_index() {
    	return view("scenario.create");
    }

    public function create(Request $request) {
        $scenario = $this->provider->get_scenario($request->scenario);

        $input = $scenario->get_stages()["init"]->input;
        $input = collect($input)->map(function($in) use ($request) {
            $in->set_value($request);
            return $in;
        });

        $scenario->create(Auth::user()->id, $input);
        $this->repo->save($scenario);
        return redirect("/scenarios/create")->with("status", "ok");
    }

    // public function answer(Request $request) {
    //     $scenario = $this->repo->get($request->scenario_id);
    //     $scenario = $this
    // }
}
