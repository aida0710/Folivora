<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\level_system\levels;

use pocketmine\utils\Config;

interface ILevel {

    /**
     * @return Config
     */
    public function getConfig() : Config;

    /**
     * @param Config $config
     * @return void
     */
    public function setConfig(Config $config) : void;

    /**
     * @return array
     */
    public function getCache() : array;

    /**
     * @param array $cache
     * @return void
     */
    public function setCache(array $cache) : void;

    /**
     * @return int
     */
    public function getDefaultLevel() : int;

    /**
     * @return int
     */
    public function getDefaultExp() : int;

    /**
     * @return int
     */
    public function getDefaultExpToNextLevel() : int;

}