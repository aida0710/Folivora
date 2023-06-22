<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\event;

use lazyperson0710\folivora\features\shop\object\ItemShopObject;
use pocketmine\event\Event;
use pocketmine\player\Player;

class ItemShopBuyEvent extends Event {

    public function __construct(
        private readonly Player $player,
        private readonly ItemShopObject $item,
        private readonly int $count,
        private readonly int $price,
    ) {
    }

    public function getPlayer(): Player {
        return $this->player;
    }

    public function getItem(): ItemShopObject {
        return $this->item;
    }

    public function getCount(): int {
        return $this->count;
    }

    public function getPrice(): int {
        return $this->price;
    }

}
