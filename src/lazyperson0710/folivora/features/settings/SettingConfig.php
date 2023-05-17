<?php

namespace lazyperson0710\folivora\features\settings;

use JsonException;
use lazyperson0710\folivora\util\config\ConfigFoundation;
use lazyperson0710\folivora\util\config\exception\ConfigSaveException;
use lazyperson0710\folivora\util\config\IConfig;
use pocketmine\player\Player;
use pocketmine\Server;

class SettingConfig implements IConfig {

    public const PATH = 'player/setting';

    public function createAccount(Player $player) : void {
    }

    /**
     * @return void
     * @throws JsonException
     */
    public function createConfigFile() : void {
        try {
            ConfigFoundation::createConfigFile(self::PATH);
        } catch (ConfigSaveException $exception) {
            Server::getInstance()->getLogger()->warning($exception);
        }
    }

    public function registerConfigClass() : void {
        ConfigFoundation::registerConfigClass($this);
    }

    public function runSave() : void {
    }
}