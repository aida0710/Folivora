<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\level_system\levels;

use lazyperson0710\folivora\features\level_system\util\LevelConfig;
use lazyperson0710\folivora\features\level_system\util\Levels;
use pocketmine\utils\SingletonTrait;

class Mining implements ILevel {

    use SingletonTrait;

    public const DEFAULT_LEVEL = 1;
    public const DEFAULT_EXP = 1;
    public const DEFAULT_LEVEL_UP_EXP = 80;

    public const LEVEL = Levels::MINING;

    private const PATH = 'player/levels/mining_level.json';

    /**
     * @return LevelConfig
     */
    public function getConfig(): LevelConfig {
        return new LevelConfig(self::LEVEL, self::PATH);
    }

    /**
     * @return int
     */
    public function getDefaultExp(): int {
        return self::DEFAULT_EXP;
    }

    /**
     * @return int
     */
    public function getDefaultExpToNextLevel(): int {
        return self::DEFAULT_LEVEL_UP_EXP;
    }

    /**
     * @return int
     */
    public function getDefaultLevel(): int {
        return self::DEFAULT_LEVEL;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return self::LEVEL->value;
    }

}
