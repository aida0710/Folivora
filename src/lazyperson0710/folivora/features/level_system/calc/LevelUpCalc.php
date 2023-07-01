<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\level_system\calc;

use lazyperson0710\folivora\features\level_system\levels\Mining;
use lazyperson0710\folivora\features\level_system\util\Levels;
use pocketmine\player\Player;

class LevelUpCalc {

    public function execute(Player $player, Levels $level, int $exp): void {
        $api = Mining::getInstance();
        $originalLevel = $api->getLevel($player);
        $level = $originalLevel;
        $upExp = $api->getLevelUpExp($player);
        $exp += $api->getExp($player);
    }

}