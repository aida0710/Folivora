<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\event;

use pocketmine\entity\effect\Effect;
use pocketmine\event\Event;
use pocketmine\player\Player;

class EffectShopBuyEvent extends Event {

    public function __construct(
        private readonly Player $player,
        private readonly Effect $effect,
        private readonly string $effectName,
        private readonly int $level,
        private readonly int $time,
        private readonly int $price,
    ) {
    }

    public function getPlayer() : Player {
        return $this->player;
    }

    public function getEffect() : Effect {
        return $this->effect;
    }

    public function getEffectName() : string {
        return $this->effectName;
    }

    public function getLevel() : int {
        return $this->level;
    }

    public function getTime() : int {
        return $this->time;
    }

    public function getPrice() : int {
        return $this->price;
    }

}
