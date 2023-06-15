<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\event;

use Error;
use lazyperson0710\folivora\features\shop\object\ItemShopObject;
use pocketmine\event\Event;
use pocketmine\player\Player;

class ItemShopSellEvent extends Event {

    public function __construct(
        private readonly Player $player,
        private readonly ItemShopObject $item,
        private readonly string $type,
    ) {
        if (($this->type === 'buy' || $this->type === 'sell') === false) {
            throw new Error('不明なタイプが指定されました -> ' . $this->type);
        }
    }

    public function getPlayer() : Player {
        return $this->player;
    }

    public function getItem() : ItemShopObject {
        return $this->item;
    }

    public function getType() : string {
        return $this->type;
    }

}
