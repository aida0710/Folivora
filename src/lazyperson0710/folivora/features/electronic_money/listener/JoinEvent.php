<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\electronic_money\listener;

use lazyperson0710\folivora\features\electronic_money\currency\EventTicket;
use lazyperson0710\folivora\features\electronic_money\currency\Money;
use lazyperson0710\folivora\features\electronic_money\currency\Ticket;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;

class JoinEvent implements Listener {

    /**
     *
     * @param PlayerJoinEvent $event
     * @return void
     */
    //note account作成系は読み込み順とかもあるからまとめた方が安全かも
    public function onJoin(PlayerJoinEvent $event) : void {
        Money::getInstance()->createAccount($event->getPlayer());
        Ticket::getInstance()->createAccount($event->getPlayer());
        EventTicket::getInstance()->createAccount($event->getPlayer());
    }

}