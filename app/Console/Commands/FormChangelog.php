<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FormChangelog extends Command {
    protected $signature = 'mind:form-changelog {--show_not_published}';
    protected $description = 'Form the changelog using file versions.php';

    private $versions;
    private $published;
    private $currentVersion;

    public function __construct() {
        parent::__construct();

        $versions = require base_path("versions.php");

        $this->versions = collect($versions["versions"])->reverse();
        $this->published = collect($versions["published"]);
        $this->currentVersion = last($versions["published"]);
    }

    public function handle() {
        $versions = $this->versions;
        if (!$this->option("show_not_published")) {
            $versions = $versions->filter(function($version) {
                return $this->published->contains($version["name"]);
            });
        }

        $text = view("changelog_template", [
            "versions" => $versions
        ])->render();

        file_put_contents(base_path("changelog.md"), $text);
    }
}
