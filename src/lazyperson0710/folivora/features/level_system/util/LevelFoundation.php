<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\level_system\util;

use lazyperson0710\folivora\util\config\ConfigFoundation;
use pocketmine\player\Player;

class LevelFoundation {

    private DefaultValue $defaultValue;

    public function __construct(
        private readonly Player $player,
        private array &$cache,
        private readonly Levels $level,
    ) {
        $this->defaultValue = new DefaultValue($this->level);
        $this->createAccount($player);
    }

    /**
     * @param Player $player
     * @return void
     */
    public function createAccount(Player $player) : void {
        if (ConfigFoundation::isAccountExist($player, $this->cache)) {
            return;
        }
        $this->cache += [
            $player->getName() => [
                DefaultValue::LEVEL_KEY => $this->defaultValue->getDefaultLevel(),
                DefaultValue::EXP_KEY => $this->defaultValue->getDefaultExp(),
                DefaultValue::EXP_TO_NEXT_LEVEL_KEY => $this->defaultValue->getDefaultExpToNextLevel(),
            ],
        ];
    }

    /**
     * @return int
     */
    public function getLevel() : int {
        $player_name = $this->player->getName();
        if (!ConfigFoundation::isAccountExist($this->player, $this->cache)) return $this->defaultValue->getDefaultLevel();
        return $this->cache[$player_name][DefaultValue::LEVEL_KEY];
    }

    /**
     * @param int $level
     * @return void
     */
    public function setLevel(int $level) : void {
        $player_name = $this->player->getName();
        if (!ConfigFoundation::isAccountExist($this->player, $this->cache)) return;
        $this->cache[$player_name][DefaultValue::LEVEL_KEY] = $level;
    }

    /**
     * @param int $level
     * @return void
     */
    public function addLevel(int $level) : void {
        $player_name = $this->player->getName();
        if (!ConfigFoundation::isAccountExist($this->player, $this->cache)) return;
        $level = $this->getLevel() + $level;
        $this->cache[$player_name][DefaultValue::EXP_KEY] = $level;
    }

    /**
     * @return int
     */
    public function getExp() : int {
        $player_name = $this->player->getName();
        if (!ConfigFoundation::isAccountExist($this->player, $this->cache)) return $this->defaultValue->getDefaultExp();
        return $this->cache[$player_name][DefaultValue::EXP_KEY];
    }

    /**
     * @param int $exp
     * @return void
     */
    public function setExp(int $exp) : void {
        $player_name = $this->player->getName();
        if (!ConfigFoundation::isAccountExist($this->player, $this->cache)) return;
        $this->cache[$player_name][DefaultValue::EXP_KEY] = $exp;
    }

    /**
     * @param int $exp
     * @return void
     */
    public function addExp(int $exp) : void {
        $player_name = $this->player->getName();
        if (!ConfigFoundation::isAccountExist($this->player, $this->cache)) return;
        $exp = $this->getExp() + $exp;
        $this->cache[$player_name][DefaultValue::EXP_KEY] = $exp;
    }

}