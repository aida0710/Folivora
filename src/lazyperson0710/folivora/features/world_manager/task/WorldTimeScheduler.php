<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\world_manager\task;

use pocketmine\scheduler\Task;
use pocketmine\Server;

class WorldTimeScheduler extends Task {

    public function onRun(): void {
        foreach (Server::getInstance()->getWorldManager()->getWorlds() as $world) {
            switch ($world->getFolderName()) {
                case 'lobby':
                case 'resource':
                case 'event-1':
                case 'tos':
                case 'pvp':
                case '八街市-f':
                    Server::getInstance()->getWorldManager()->getWorldByName($world->getFolderName())->setTime(18000);
                    Server::getInstance()->getWorldManager()->getWorldByName($world->getFolderName())->stopTime();
                    break;
                default:
                    Server::getInstance()->getWorldManager()->getWorldByName($world->getFolderName())->setTime(6000);
                    Server::getInstance()->getWorldManager()->getWorldByName($world->getFolderName())->stopTime();
                    break;
            }
        }
    }
}
