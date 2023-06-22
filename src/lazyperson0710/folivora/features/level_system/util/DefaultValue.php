<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\level_system\util;

use lazyperson0710\folivora\features\level_system\levels\Build;
use lazyperson0710\folivora\features\level_system\levels\Farming;
use lazyperson0710\folivora\features\level_system\levels\Mining;
use pocketmine\utils\SingletonTrait;

class DefaultValue {

    use SingletonTrait;

    public const LEVEL_KEY = 'level';
    public const EXP_KEY = 'exp';
    public const EXP_TO_NEXT_LEVEL_KEY = 'exp_to_next_level';

    private int $defaultLevel;
    private int $defaultExp;
    private int $defaultExpToNextLevel;

    public function __construct(
        private readonly Levels $levels,
    ) {
        //note 読み込まれてない?
        var_dump('load constructor is Default Value');
        $levelClass = match ($this->levels) {
            Levels::MINING => new Mining(),
            Levels::FARMING => new Farming(),
            Levels::BUILD => new Build(),
        };
        $this->defaultLevel = $levelClass::DEFAULT_LEVEL;
        $this->defaultExp = $levelClass::DEFAULT_EXP;
        $this->defaultExpToNextLevel = $levelClass::DEFAULT_LEVEL_UP_EXP;
    }

    /**
     * @return int
     */
    public function getDefaultLevel() : int {
        return $this->defaultLevel;
    }

    /**
     * @return int
     */
    public function getDefaultExp() : int {
        return $this->defaultExp;
    }

    /**
     * @return int
     */
    public function getDefaultExpToNextLevel() : int {
        return $this->defaultExpToNextLevel;
    }
}