<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Excel\ReaderProvider;

class LoadExcel extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'excel:load {reader} {file}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Load excel file by a reader';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle(ReaderProvider $readers) {
		$reader = $this->argument("reader");
		$file = $this->argument("file");

		if (!$readers->has_reader($reader)) {
			$this->error("No such reader");
			return;
		}

		$reader = $readers->get_reader($reader);
		$reader->load($file);
		$this->info("Successful!");
	}
}
