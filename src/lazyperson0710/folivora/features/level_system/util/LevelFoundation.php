<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\level_system\util;

use lazyperson0710\folivora\features\level_system\levels\ILevel;
use lazyperson0710\folivora\util\config\ConfigFoundation;
use pocketmine\player\Player;

class LevelFoundation {

    public function __construct(
        private readonly Player $player,
        private array &$configCache,
        private readonly ILevel $levelClass,
    ) {
        $this->createAccount($player);
    }

    /**
     * @param Player $player
     * @return void
     */
    public function createAccount(Player $player) : void {
        if (!ConfigFoundation::isAccountExist($player, $this->configCache)) {
            $this->configCache += [
                $player->getName() => [
                    ($this->levelClass)::LEVEL_KEY => $this->levelClass->getDefaultLevel(),
                    ($this->levelClass)::EXP_KEY => $this->levelClass->getDefaultExp(),
                    ($this->levelClass)::EXP_TO_NEXT_LEVEL_KEY => $this->levelClass->getDefaultExpToNextLevel(),
                ],
            ];
        }
    }

    /**
     * @param int $exp
     * @return void
     */
    public function setExp(int $exp) : void {
        $player_name = $this->player->getName();
        if (!ConfigFoundation::isAccountExist($this->player, $this->configCache)) return;
        $this->configCache[$player_name][($this->levelClass)::EXP_KEY] = $exp;
    }

    /**
     * @param int $exp
     * @return void
     */
    public function addExp(int $exp) : void {
        $player_name = $this->player->getName();
        if (!ConfigFoundation::isAccountExist($this->player, $this->configCache)) return;
        $exp = $this->getExp() + $exp;
        $this->configCache[$player_name][($this->levelClass)::EXP_KEY] = $exp;
    }

    /**
     * @return int
     */
    public function getExp() : int {
        $player_name = $this->player->getName();
        if (!ConfigFoundation::isAccountExist($this->player, $this->configCache)) return $this->levelClass->getDefaultExp();
        return $this->configCache[$player_name][($this->levelClass)::EXP_KEY];
    }

    /**
     * @return array
     */
    public function getAllPlayerData() : array {
        return $this->configCache;
    }

}