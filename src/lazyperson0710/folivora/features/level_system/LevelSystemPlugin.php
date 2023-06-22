<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\level_system;

use JsonException;
use lazyperson0710\folivora\features\level_system\levels\Build;
use lazyperson0710\folivora\features\level_system\levels\Farming;
use lazyperson0710\folivora\features\level_system\levels\Mining;
use lazyperson0710\folivora\features\level_system\listener\MiningLevelListener;
use lazyperson0710\folivora\util\plugin_base\IPluginBase;
use lazyperson0710\folivora\util\register\RegisterListener;
use pocketmine\Server;

class LevelSystemPlugin implements IPluginBase {

    /**
     * @param Server $server
     * @return void
     */
    public function onDisable(Server $server): void {
    }

    /**
     * @param Server $server
     * @return void
     * @throws JsonException
     */
    public function onEnable(Server $server): void {
        $this->registerConfigClass();
        $this->createConfig();
        RegisterListener::register(new MiningLevelListener());
    }

    /**
     * @return void
     */
    private function registerConfigClass(): void {
        Mining::getInstance()->getConfig()->registerConfigClass();
        Farming::getInstance()->getConfig()->registerConfigClass();
        Build::getInstance()->getConfig()->registerConfigClass();
    }

    /**
     * @return void
     * @throws JsonException
     */
    private function createConfig(): void {
        Mining::getInstance()->getConfig()->createConfigFile();
        Farming::getInstance()->getConfig()->createConfigFile();
        Build::getInstance()->getConfig()->createConfigFile();
    }

}
