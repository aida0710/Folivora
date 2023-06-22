<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\other\listener;

use pocketmine\entity\object\ItemEntity;
use pocketmine\event\entity\ItemSpawnEvent;
use pocketmine\event\Listener;

class DropItemSetDeleteTime implements Listener {

    private const DeleteTime = 20 * 60;

    public function onDropItemSetDeleteTime(ItemSpawnEvent $event): void {
        if ($event->getEntity() instanceof ItemEntity) {
            $event->getEntity()->setDespawnDelay(self::DeleteTime);
        }
    }

}
