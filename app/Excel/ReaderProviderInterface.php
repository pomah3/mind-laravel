<?php

namespace App\Excel;

interface ReaderProviderInterface {
	public function get_readers(): array;
	public function get_reader(string $name): Reader;
	public function has_reader(string $name): bool;
}
