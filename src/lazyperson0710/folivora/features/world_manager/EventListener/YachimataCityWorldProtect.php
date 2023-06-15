<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\world_manager\EventListener;

use lazyperson0710\folivora\features\world_manager\database\WorldCategory;
use lazyperson0710\folivora\util\message\send_message\SendTip;
use pocketmine\block\VanillaBlocks;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\VanillaItems;

class YachimataCityWorldProtect implements Listener {

    /**
     * @param BlockBreakEvent $event
     * @return void
     * @priority Low
     */
    public function onBreak(BlockBreakEvent $event) : void {
        if (in_array($event->getPlayer()->getPosition()->getWorld()->getFolderName(), WorldCategory::UniqueAgricultureWorld, true)) {
            $blocks = [
                VanillaBlocks::WHEAT()->getId(),
                VanillaBlocks::POTATOES()->getId(),
                VanillaBlocks::CARROTS()->getId(),
                VanillaBlocks::BEETROOTS()->getId(),
            ];
            if (!in_array($event->getBlock()->getId(), $blocks, true)) {
                SendTip::Send($event->getPlayer(), "現在のワールドでは{$event->getBlock()->getName()}の破壊は許可されていません", 'Protect', false);
                $event->cancel();
            }
        }
    }

    /**
     * @param BlockPlaceEvent $event
     * @return void
     * @priority Low
     */
    public function onPlace(BlockPlaceEvent $event) : void {
        if (in_array($event->getPlayer()->getPosition()->getWorld()->getFolderName(), WorldCategory::UniqueAgricultureWorld, true)) {
            $items = [
                VanillaItems::WHEAT_SEEDS()->getId(),
                VanillaItems::POTATO()->getId(),
                VanillaItems::CARROT()->getId(),
                VanillaItems::BEETROOT_SEEDS()->getId(),
            ];
            if (!in_array($event->getPlayer()->getInventory()->getItemInHand()->getId(), $items, true)) {
                SendTip::Send($event->getPlayer(), "現在のワールドでは{$event->getPlayer()->getInventory()->getItemInHand()->getName()}の設置は許可されていません", 'Protect', false);
                $event->cancel();
            }
        }
    }

    /**
     * @param PlayerInteractEvent $event
     * @return void
     */
    public function onInteract(PlayerInteractEvent $event) : void {
        if (in_array($event->getBlock()->getPosition()->getWorld()->getFolderName(), WorldCategory::UniqueAgricultureWorld, true)) {
            $items = [
                VanillaItems::WHEAT_SEEDS()->getId(),
                VanillaItems::POTATO()->getId(),
                VanillaItems::CARROT()->getId(),
                VanillaItems::BEETROOT_SEEDS()->getId(),
            ];
            if (!in_array($event->getPlayer()->getInventory()->getItemInHand()->getId(), $items, true)) {
                SendTip::Send($event->getPlayer(), "現在のワールドでは{$event->getPlayer()->getInventory()->getItemInHand()->getName()}の使用は許可されていません", 'Protect', false);
                $event->cancel();
            }
        }
    }

}
