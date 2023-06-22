<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\world_manager\EventListener;

use lazyperson0710\folivora\features\world_manager\database\WorldCategory;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerExhaustEvent;

class StopHunger implements Listener {

    public function onHunger(PlayerExhaustEvent $event): void {
        $WorldName = $event->getPlayer()->getWorld()->getFolderName();
        if (in_array($WorldName, WorldCategory::PublicWorld, true) || in_array($WorldName, WorldCategory::PublicEventWorld, true)) {
            $event->cancel();
        }
    }
}
