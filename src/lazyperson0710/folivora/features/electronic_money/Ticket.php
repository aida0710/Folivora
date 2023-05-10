<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\electronic_money;

use lazyperson0710\folivora\util\config\features\PlayerData;
use pocketmine\player\Player;
use pocketmine\utils\SingletonTrait;

class Ticket {

    use SingletonTrait;

    public const NAME = "Ticket";
    public const SUFFIX = '枚';
    public const DEFAULT_CURRENCY = 15;

    public function setTicket(Player $player, int $quantity) : void {
        if ($quantity < 0) $quantity = 0;
        PlayerData::getInstance()->setPlayerData($player, [self::NAME => $quantity]);
    }

    public function getTicket(Player $player) : int {
        $playerData = PlayerData::getInstance()->getPlayerData($player);
        return $playerData[self::NAME];
    }

    public function addTicket(Player $player, int $quantity) : void {
        $currentMoney = $this->getTicket($player);
        $ticket = $currentMoney + $quantity;
        $this->setTicket($player, $ticket);
    }

    public function reduceTicket(Player $player, int $quantity) : void {
        $currentMoney = $this->getTicket($player);
        $ticket = $currentMoney - $quantity;
        $this->setTicket($player, $ticket);
    }

}
