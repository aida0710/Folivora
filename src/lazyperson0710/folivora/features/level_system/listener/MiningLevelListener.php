<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\level_system\listener;

use lazyperson0710\folivora\features\level_system\levels\Mining;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;

class MiningLevelListener implements Listener {

    /**
     * @param BlockBreakEvent $event
     * @return void
     */
    public function onBreakBlock(BlockBreakEvent $event) : void {
        if ($event->isCancelled()) return;
        $player = $event->getPlayer();
        Mining::getInstance()->getConfig()->getFunction($player)->addExp(1);
        var_dump(Mining::getInstance()->getConfig()->getFunction($player)->getExp());
    }

}