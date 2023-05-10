<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora;

use lazyperson0710\folivora\util\register\RegisterFeatures;
use lazyperson0710\folivora\util\register\RegisterListener;
use lazyperson0710\folivora\util\register\RegisterTask;
use pocketmine\plugin\PluginBase;
use RuntimeException;

class Folivora extends PluginBase {

    private static string $dataPath;

    protected function onEnable() : void {
        self::$dataPath = $this->getDataFolder();
        RegisterListener::setPlugin($this);
        RegisterTask::init($this->getScheduler());
        RegisterFeatures::enableFeatures($this->getServer());
    }

    protected function onDisable() : void {
    }

    public static function getDataPath() : string {
        if (!isset(self::$dataPath)) throw new RuntimeException("Path is not set.");
        return self::$dataPath;
    }
}
