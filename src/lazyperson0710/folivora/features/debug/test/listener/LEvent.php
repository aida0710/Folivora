<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\debug\test\listener;

use bbo51dog\pmdiscord\connection\Webhook;
use bbo51dog\pmdiscord\element\Embed;
use bbo51dog\pmdiscord\element\Embeds;
use DateTime;
use DateTimeInterface;
use lazyperson0710\folivora\features\level_system\levels\Build;
use lazyperson0710\folivora\features\level_system\levels\Farming;
use lazyperson0710\folivora\features\level_system\levels\Mining;
use lazyperson0710\folivora\util\webhook\WebHookURL;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerJumpEvent;

class LEvent implements Listener {

    public function onJoin(PlayerJoinEvent $event): void {
        $webhook = Webhook::create(WebHookURL::getInstance()->getURL('debug'));
        $webhook->setCustomName('setCustomName');
        $webhook->setCustomAvatar('https://lazyperson0710.tech/assets/profile/icon/neko.jpg');
        $embed = (new Embed())
            ->setTitle('title')
            ->setColor(13421619)
            ->setAuthorName('AuthorName')
            ->setTime((new DateTime())->format(DateTimeInterface::ATOM));
        $embeds = new Embeds();
        $embeds->add($embed);
        $webhook->add($embeds);
        $webhook->send();
    }

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