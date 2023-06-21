<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\util\packet;

use pocketmine\entity\effect\Effect;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\player\Player;

class AddEffectPacket {

    /**
     * @param Player         $player
     * @param EffectInstance $effect
     * @param Effect         $vanillaEffects
     * @param bool|null      $force
     * @return void
     */
    public static function Add(Player $player, EffectInstance $effect, Effect $vanillaEffects, ?bool $force = false) : void {
        $effectInstance = $player->getEffects()->get($vanillaEffects);
        if ($force === true || $effectInstance === null) {
            $player->getEffects()->add($effect);
        } elseif ($effectInstance->getDuration() < 499) {
            $player->getEffects()->add($effect);
        }
    }

}
