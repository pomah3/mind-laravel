<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Excel\ReaderProvider;

class ListExcel extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'excel:list';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'List all excel readers';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle(ReaderProvider $readers)
	{
		foreach ($readers->get_readers() as $reader_name => $reader) {
			$this->line("  - ".$reader_name . " ('".$reader->get_name()."')");
		}
	}
}
