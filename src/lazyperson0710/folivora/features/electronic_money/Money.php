<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\electronic_money;

use lazyperson0710\folivora\util\config\features\PlayerData;
use pocketmine\player\Player;
use pocketmine\utils\SingletonTrait;

class Money {

    use SingletonTrait;

    public const NAME = "Money";
    public const SUFFIX = '円';
    public const DEFAULT_CURRENCY = 1500;

    public function addMoney(Player $player, int $quantity) : void {
        $currentMoney = $this->getMoney($player);
        $money = $currentMoney + $quantity;
        $this->setMoney($player, $money);
    }

    public function getMoney(Player $player) : int {
        $playerData = PlayerData::getInstance()->getPlayerData($player);
        return $playerData[self::NAME];
    }

    public function setMoney(Player $player, int $quantity) : void {
        if ($quantity < 0) $quantity = 0;
        PlayerData::getInstance()->setData($player, self::NAME, $quantity);
    }

    public function reduceMoney(Player $player, int $quantity) : void {
        $currentMoney = $this->getMoney($player);
        $money = $currentMoney - $quantity;
        if ($money < 0) $money = 0;
        $this->setMoney($player, $money);
    }

}
