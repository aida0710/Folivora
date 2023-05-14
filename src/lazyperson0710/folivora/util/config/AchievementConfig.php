<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\util\config;

use JsonException;
use lazyperson0710\folivora\util\exception\ConfigSaveException;
use pocketmine\utils\Config;

class AchievementConfig extends ConfigFoundation {

    private static Config $config;

    /**
     * @throws JsonException
     */
    public function __construct() {
        if (isset(self::$config)) {
            return;
        }
        try {
            self::$config = $this->createConfigFile('achievement.json');
        } catch (ConfigSaveException $error) {
            throw new ConfigSaveException($error->getMessage());
        }
    }

}