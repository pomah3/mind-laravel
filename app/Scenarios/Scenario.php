<?php

namespace App\Scenarios;

use App\User;

abstract class Scenario {
    public $id = null;
    private $stage;
    private $data;
    private $users;

    public function get_stage() {
        return $this->stage;
    }

    public function set_stage(string $stage) {
        $this->stage = $stage;
    }

    public function get_data(string $key) {
        return $this->data[$key];
    }

    public function get_all_data() {
        return $this->data;
    }

    public function set_all_data(array $data) {
        $this->data = $data;
    }

    public function set_data(string $key, $value) {
        $this->data[$key] = $value;
    }

    public function get_users(): array {
        return $this->users;
    }

    public function set_users(array $users) {
        $this->users = $users;
    }

    public function __construct(string $stage = "init", array $data = [], array $users = []) {
        $this->stage = $stage;
        $this->data = $data;
        $this->users = $users;
    }

    public function create(User $user, array $input) {
        $obj = (new \ReflectionClass($this))->newInstance();
        $obj->handle($user, $input);
        return $obj;
    }

    public function handle(User $user, $input) {
        $stage = $this->get_stage();
        $stage = $this->get_stages()[$stage];
        ($stage->handle)($this, $input, $user);
    }

    public function get_output(User $user) {
        $stage = $this->get_stage();
        return ($this->get_stages()[$stage]->output)($this, $user);
    }

    public function get_input() {
        $stage = $this->get_stage();
        return $this->get_stages()[$stage]->input;
    }

    public function get_name() {
        return (new \ReflectionClass($this))->getName();
    }

    public function is_finished() {
        return $this->get_stages()[$this->get_stage()]->is_final();
    }

    abstract public function get_stages();
    abstract public function get_title();
}
