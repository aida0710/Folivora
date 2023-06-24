<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\debug\test\listener;

use lazyperson0710\folivora\features\level_system\levels\Build;
use lazyperson0710\folivora\features\level_system\levels\Farming;
use lazyperson0710\folivora\features\level_system\levels\Mining;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerJumpEvent;

class LEvent implements Listener {

    /**
     * @param BlockBreakEvent $event
     * @return void
     */
    public function onBreakBlock(BlockBreakEvent $event): void {
        if ($event->isCancelled()) return;
        $player = $event->getPlayer();
        Mining::getInstance()->getConfig()->getFunction($player)->addExp(1);
        var_dump('mining - ' . Mining::getInstance()->getConfig()->getFunction($player)->getExp());
    }

    /**
     * @param PlayerJumpEvent $event
     * @return void
     */
    public function onJump(PlayerJumpEvent $event): void {
        $player = $event->getPlayer();
        Farming::getInstance()->getConfig()->getFunction($player)->addExp(1);
        var_dump('farming - ' . Farming::getInstance()->getConfig()->getFunction($player)->getExp());
    }

    /**
     * @param PlayerInteractEvent $event
     * @return void
     */
    public function onInteract(PlayerInteractEvent $event): void {
        $player = $event->getPlayer();
        Build::getInstance()->getConfig()->getFunction($player)->addExp(1);
        var_dump('build - ' . Build::getInstance()->getConfig()->getFunction($player)->getExp());
    }

}