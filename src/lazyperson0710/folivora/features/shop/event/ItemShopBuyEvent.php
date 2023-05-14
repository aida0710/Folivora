<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\event;

use lazyperson0710\folivora\features\shop\object\LevelShopItem;
use pocketmine\event\Event;
use pocketmine\player\Player;

class ItemShopBuyEvent extends Event {

    public function __construct(
        private Player $player,
        private LevelShopItem $item,
    ) {
    }

    public function getPlayer() : Player {
        return $this->player;
    }

    public function getItem() : LevelShopItem {
        return $this->item;
    }

}
