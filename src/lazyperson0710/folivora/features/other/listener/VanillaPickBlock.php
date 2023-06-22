<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\other\listener;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerBlockPickEvent;

class VanillaPickBlock implements Listener {

    /**
     * @priority LOWEST
     */
    public function onPlayerPickBlock(PlayerBlockPickEvent $event): void {
        $event->cancel();
        $player = $event->getPlayer();
        if ($player->isSpectator()) {
            return;
        }
        $inventory = $player->getInventory();
        $resultItem = $event->getResultItem();
        $hatBarSize = $inventory->getHotbarSize();
        $originSlot = -1;
        foreach ($inventory->getContents() as $i => $item) {
            if ($resultItem->equals($item, true, true)) {
                $resultItem = $item;
                $originSlot = $i;
                break;
            }
        }
        if ($originSlot >= 0 && $originSlot < $hatBarSize) {
            $inventory->setHeldItemIndex($originSlot);
            return;
        }
        $targetItem = $inventory->getItemInHand();
        $targetSlot = $inventory->getHeldItemIndex();
        if (!$targetItem->isNull()) {
            for ($i = 0; $i < $hatBarSize; ++$i) { //Find empty hotBar slot
                $item = $inventory->getItem($i);
                if ($item->isNull()) {
                    $targetItem = $item;
                    $targetSlot = $i;
                    $inventory->setHeldItemIndex($targetSlot);
                    break;
                }
            }
        }
        if ($originSlot !== -1) {
            $inventory->setItem($targetSlot, $resultItem);
            $inventory->setItem($originSlot, $targetItem);
        } elseif ($player->isCreative()) {
            $inventory->setItem($targetSlot, $resultItem);
            if (!$targetItem->isNull()) {
                $inventory->addItem($targetItem);
            }
        }
    }
}
