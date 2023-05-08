<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora;

use pocketmine\plugin\PluginBase;
use RuntimeException;

class Folivora extends PluginBase {

    private static string $dataPath;

    protected function onEnable() : void {
        self::$dataPath = $this->getDataFolder();
    }

	protected function onDisable() : void {
	}

    public static function getDataPath() : string {
        if (!isset(self::$dataPath)) throw new RuntimeException("Path is not set.");
        return self::$dataPath;
    }
}
