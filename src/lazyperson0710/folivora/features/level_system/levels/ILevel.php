<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\level_system\levels;

use lazyperson0710\folivora\features\level_system\util\LevelConfig;

interface ILevel {

    public const LEVEL_KEY = 'level';
    public const EXP_KEY = 'exp';
    public const EXP_TO_NEXT_LEVEL_KEY = 'exp_to_next_level';

    /**
     * @return LevelConfig
     */
    public function getConfig() : LevelConfig;

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