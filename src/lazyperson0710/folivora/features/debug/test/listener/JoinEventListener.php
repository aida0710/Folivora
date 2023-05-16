<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\debug\test\listener;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;

class JoinEventListener implements Listener {

    /**
     * @priority HIGHEST
     */
    public function onJoin(PlayerJoinEvent $event) : void {
        $player = $event->getPlayer();
        //if (PlayerData::getInstance()->dataExists($player) !== true) {
        //	PlayerData::getInstance()->createData($event->getPlayer());
        //	$player->sendMessage('playerデータを作成しました');
        //}
    }
}
