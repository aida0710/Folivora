<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora;

use lazyperson0710\folivora\util\register\RegisterConfig;
use lazyperson0710\folivora\util\register\RegisterFeatures;
use lazyperson0710\folivora\util\register\RegisterListener;
use lazyperson0710\folivora\util\register\RegisterTaskScheduler;
use pocketmine\plugin\PluginBase;

class Folivora extends PluginBase {

    protected function onEnable() : void {
        RegisterConfig::setDataPath($this->getDataFolder());
        RegisterListener::setPlugin($this);
        RegisterTaskScheduler::init($this->getScheduler());
        RegisterFeatures::enableFeatures($this->getServer());
    }

    protected function onDisable() : void {
        RegisterFeatures::disableFeatures($this->getServer());
    }
}
