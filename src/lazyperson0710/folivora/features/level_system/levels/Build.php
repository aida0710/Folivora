<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\level_system\levels;

use lazyperson0710\folivora\features\level_system\util\LevelConfig;
use pocketmine\utils\SingletonTrait;

class Build implements ILevel {

    use SingletonTrait;

    private const DEFAULT_LEVEL = 1;
    private const DEFAULT_EXP = 1;
    private const DEFAULT_LEVEL_UP_EXP = 250;
    public const PATH = 'player/levels/build_level.json';

    /**
     * @return LevelConfig
     */
    public function getConfig() : LevelConfig {
        return new LevelConfig(self::PATH, $this);
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
