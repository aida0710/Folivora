<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\level_system\levels;

use pocketmine\utils\Config;
use pocketmine\utils\SingletonTrait;

class Mining implements ILevel {

    use SingletonTrait;

    private const DEFAULT_LEVEL = 1;
    private const DEFAULT_EXP = 1;
    private const DEFAULT_LEVEL_UP_EXP = 80;

    private const PATH = 'player/levels/mining_level.json';

    private static Config $config;
    private static array $cache;

    /**
     * @return Config
     */
    public function getConfig() : Config {
    }

    /**
     * @param Config $config
     * @return void
     */
    public function setConfig(Config $config) : void {
    }

    /**
     * @return array
     */
    public function getCache() : array {
    }

    /**
     * @param array $cache
     * @return void
     */
    public function setCache(array $cache) : void {
    }

    /**
     * @return int
     */
    public function getDefaultLevel() : int {
        return self::DEFAULT_LEVEL;
    }

    /**
     * @return int
     */
    public function getDefaultExp() : int {
        return self::DEFAULT_EXP;
    }

    /**
     * @return int
     */
    public function getDefaultExpToNextLevel() : int {
        return self::DEFAULT_LEVEL_UP_EXP;
    }

}
