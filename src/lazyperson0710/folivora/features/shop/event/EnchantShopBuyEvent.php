<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\event;

use pocketmine\event\Event;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\player\Player;

class EnchantShopBuyEvent extends Event {

    public function __construct(
        private readonly Player $player,
        private readonly Enchantment $enchant,
        private readonly string $enchantName,
        private readonly int $level,
        private readonly int $price,
    ) {
    }

    public function getPlayer() : Player {
        return $this->player;
    }

    public function getEnchant() : Enchantment {
        return $this->enchant;
    }

    public function getEnchantName() : string {
        return $this->enchantName;
    }

    public function getLevel() : int {
        return $this->level;
    }

    public function getPrice() : int {
        return $this->price;
    }

}
