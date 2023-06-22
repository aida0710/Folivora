<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\util\packet;

use pocketmine\network\mcpe\protocol\GameRulesChangedPacket;
use pocketmine\network\mcpe\protocol\types\BoolGameRule;
use pocketmine\player\Player;

class CoordinatesPacket {

    /**
     * @param Player $player
     * @param bool   $value
     * @return void
     */
    public static function Send(Player $player, bool $value): void {
        $pk = new GameRulesChangedPacket();
        $pk->gameRules = ['showcoordinates' => new BoolGameRule($value, false)];
        $player->getNetworkSession()->sendDataPacket($pk);
    }
}
