<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\debug\test\listener;

use lazyperson0710\folivora\features\electronic_money\Money;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;

class BreakListener implements Listener {

    public function onBreak(BlockBreakEvent $event) : void {
        Money::getInstance()->addMoney($event->getPlayer(), 1);
    }

}
