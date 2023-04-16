<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\util\config;

use pocketmine\utils\SingletonTrait;
use RuntimeException;

class ConfigDataPath {

	use SingletonTrait;

	static private string $path;

	public function setPath(string $path) : void {
		self::$path = $path;
	}

	public function getPath() : string {
		if (!isset(self::$path)) throw new RuntimeException("Path is not set.");
		return self::$path;
	}
}
