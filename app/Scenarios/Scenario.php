<?php

namespace App\Scenarios;

abstract class Scenario {
    public $id = null;
    private $stage;
    private $data;
    private $user;

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

    public function get_user(): ?string {
        return $this->user;
    }

    public function set_user(?string $user) {
        $this->user = $user;
    }

    public function __construct(string $stage = "init", array $data = [], ?string $user = null) {
        $this->stage = $stage;
        $this->data = $data;
        $this->user = $user;
    }

    public function create(string $user, array $input) {
        $obj = (new \ReflectionClass($this))->newInstance();
        $obj->handle($user, $input);
        return $obj;
    }

    public function handle(string $user, $input) {
        $stage = $this->get_stage();
        $stage = $this->get_stages()[$stage];
        ($stage->handle)($this, $input, $user);
    }

    public function get_output() {
        $stage = $this->get_stage();
        return ($this->get_stages()[$stage]->output)($this);
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
