<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\world_manager\task;

use lazyperson0710\folivora\features\world_manager\database\WorldManagementAPI;
use lazyperson0710\folivora\util\message\send_message\SendMessage;
use pocketmine\scheduler\Task;
use pocketmine\Server;

class WorldLevelCheckTask extends Task {

    public function onRun() : void {
        foreach (Server::getInstance()->getOnlinePlayers() as $player) {
            $worldApi = WorldManagementAPI::getInstance();
            //note miningAPI is not a thing
            if (MiningLevelAPI::getInstance()->getLevel($player) < $worldApi->getMiningLevelLimit($player->getWorld()->getFolderName())) {
                Server::getInstance()->dispatchCommand($player, 'warp lobby');
                SendMessage::Send($player, '移動した先のワールドはまだ解放されていない為ロビーに戻されました', 'World', false);
            }
        }
    }

}
