<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\util\config;

use lazyperson0710\folivora\features\level_system\util\LevelFoundation;
use pocketmine\player\Player;

interface IConfig {

    /**
     * 起動時に必ず実行してください。
     *
     * @return void
     */
    public function createConfigFile(): void;

    /**
     * 起動時に必ず実行してください。
     *
     * @return void
     */
    public function registerConfigClass(): void;

    /**
     * $this->config->save(); のみ記述し、実行処理は全てConfigFoundation::runAllSave() に任せてください。
     * 例外がない限りは直接実行しないでください。
     *
     * @return void
     * @see ConfigFoundation::runAllSave()
     *
     */
    public function runSave(): void;

    /**
     * @param Player $player
     * @return LevelFoundation
     */
    public function getFunction(Player $player): LevelFoundation;

    /**
     * @return array
     */
    public function getAllPlayerData(): array;

}