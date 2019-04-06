<?php

namespace App\Scenarios;

use App\Scenarios\Scenario;
use App\User;
use Illuminate\Support\Facades\DB;

class ScenarioRepositoryImpl implements ScenarioRepository {
    public function get_all() {
        $scs = DB::table("scenarios")->get();
        return $this->parse_collection($scs);
    }

    public function get_all_of(User $user) {
        $scs = DB::table("scenario_user")
                 ->where("user_id", $user->id)
                 ->get();

        $scs = $scs->map(function($a) {
            return DB::table("scenarios")
                     ->where("id", $a->scenario_id)
                     ->first();
        });

        return $this->parse_collection($scs);
    }

    public function get($id) {
        $sc = DB::table("scenarios")
                ->where("id", $id)
                ->first();

        if ($sc == null)
            return null;

        $scenario = $this->parse($sc);

        $users_a = [];
        $users = DB::table("scenario_user")->where("scenario_id", $id)->get();
        foreach ($users as $user) {
            $users_a[] = User::find($user->user_id);
        }

        $scenario->set_users($users_a);

        return $scenario;
    }

    public function save(Scenario $scenario) {
        if ($scenario->id) {
            DB::table("scenarios")
              ->where("id", $scenario->id)
              ->update($this->deparse($scenario));
        } else {
            $id = DB::table("scenarios")
                    ->insertGetId(
                        $this->deparse($scenario)
                    );

            $scenario->id = $id;
        }

        DB::table("scenario_user")
          ->where("scenario_id", $scenario->id)
          ->delete();

        foreach ($scenario->get_users() as $user) {
            DB::table("scenario_user")->insert([
                "scenario_id" => $scenario->id,
                "user_id" => $user->id
            ]);
        }
    }

    public function delete(Scenario $scenario) {
        DB::table("scenarios")->where("id", $scenario->id)->delete();
        DB::table("scenario_user")->where("scenario_id", $scenario->id)->delete();
    }

    private function parse_collection($collection) {
        return $collection->map(function($std) {
            return $this->parse($std);
        });
    }

    private function deparse($sc) {
        return [
            "stage" => $sc->get_stage(),
            "data" => json_encode($sc->get_all_data()),
            "type" => $sc->get_name()
        ];
    }

    private function parse($std) {
        $s = (new \ReflectionClass($std->type))->newInstance();
        $s->id = $std->id;
        $s->set_stage($std->stage);
        $s->set_all_data(json_decode($std->data, true));

        return $s;
    }
}
