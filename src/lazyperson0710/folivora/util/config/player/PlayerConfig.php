<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\util\config\player;

use JsonException;
use lazyperson0710\folivora\util\config\ConfigFoundation;
use lazyperson0710\folivora\util\exception\ConfigSaveException;
use pocketmine\player\Player;
use pocketmine\utils\Config;

class PlayerConfig extends ConfigFoundation {

    private static Config $config;
    private array $cash = [];

    /**
     * @throws JsonException
     */
    public function __construct() {
        if (isset(self::$config)) {
            return;
        }
        try {
            self::$config = $this->createConfigFile('player/player.json');
            $this->cash = self::$config->getAll();
        } catch (ConfigSaveException $error) {
            throw new ConfigSaveException($error->getMessage());
        }
    }

    public static function getConfig() : Config {
        return self::$config;
    }

    public function getCache() : array {
        return $this->cash;
    }

    public function setMoney(Player $player, int $money) : void {
        $this->cash[$player->getName()] = $money;
    }

}