<?php

namespace App\Excel;

class ReaderProvider implements ReaderProviderInterface {
	const READER_NAMESPACE = 'App\Excel\Readers';
	const READER_PATH = __DIR__.'/Readers';

	private $readers = null;

	public function get_readers(): array {
		if ($this->readers !== null)
			return $this->readers;

		$files = scandir(static::READER_PATH);
		$files = $files ? $files : [];

		$arr = [];

		foreach ($files as $file) {
			if ($file == "." || $file == "..")
				continue;

			$reader = pathinfo($file)["filename"];

			$arr[$reader] = (new \ReflectionClass(static::READER_NAMESPACE.'\\'.$reader))->newInstance();
		}

		$this->readers = $arr;

		return $arr;
	}

	public function get_reader(string $name): Reader {
		return $this->get_readers()[$name];
	}

	public function has_reader(string $name): bool {
		return isset($this->get_readers()[$name]);
	}
}
