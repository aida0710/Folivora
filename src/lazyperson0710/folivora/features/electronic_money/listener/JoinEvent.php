<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\electronic_money\listener;

use lazyperson0710\folivora\features\electronic_money\Money;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;

class JoinEvent implements Listener {

    public function onJoin(PlayerJoinEvent $event) : void {
        Money::getInstance()->createAccount($event->getPlayer());
    }

}