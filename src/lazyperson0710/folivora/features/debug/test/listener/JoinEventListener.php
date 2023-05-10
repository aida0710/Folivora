<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\debug\test\listener;

use lazyperson0710\folivora\util\register\RegisterTaskScheduler;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\scheduler\ClosureTask;
use pocketmine\Server;

class JoinEventListener implements Listener {

    /**
     * @priority HIGHEST
     */
    public function onJoin(PlayerJoinEvent $event) : void {
        $player = $event->getPlayer();
        Server::getInstance()->getLogger()->warning($player->getName() . 'が参加しました');
        RegisterTaskScheduler::getScheduler()->scheduleDelayedTask(new ClosureTask(
            function () use ($player) : void {
                Server::getInstance()->getLogger()->warning($player->getName() . 'が参加してから5秒経過しました');
            }
        ), 20 * 5);
        //if (PlayerData::getInstance()->dataExists($player) !== true) {
        //	PlayerData::getInstance()->createData($event->getPlayer());
        //	$player->sendMessage('playerデータを作成しました');
        //}
    }
}
