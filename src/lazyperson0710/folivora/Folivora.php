<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora;

use lazyperson0710\folivora\util\config\ConfigFoundation;
use lazyperson0710\folivora\util\register\RegisterFeatures;
use lazyperson0710\folivora\util\register\RegisterListener;
use lazyperson0710\folivora\util\register\RegisterTaskScheduler;
use lazyperson0710\folivora\util\webhook\WebHookURL;
use pocketmine\plugin\PluginBase;

class Folivora extends PluginBase {

    /**
     * @return void
     */
    protected function onDisable(): void {
        RegisterFeatures::disableFeatures($this->getServer());
    }

    /**
     * @return void
     */
    protected function onEnable(): void {
        RegisterTaskScheduler::init($this->getScheduler());
        ConfigFoundation::init($this->getDataFolder());
        RegisterListener::setPlugin($this);
        RegisterFeatures::enableFeatures($this->getServer());
        var_dump(WebHookURL::getInstance()->getAllURL());
    }

}
