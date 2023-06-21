<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\level_system\levels;

use lazyperson0710\folivora\features\level_system\util\LevelConfig;

interface ILevel {

    /**
     * @return LevelConfig
     */
    public function getConfig() : LevelConfig;

    /**
     * @return string
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