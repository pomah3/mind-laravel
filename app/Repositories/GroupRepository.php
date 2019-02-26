<?php

namespace App\Repositories;

interface GroupRepository {
    public function get_names();
    public function get_pars();

    public function get_all();
    public function get($group);
}
