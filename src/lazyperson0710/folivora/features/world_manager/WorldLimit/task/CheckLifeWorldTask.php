<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\world_manager\WorldLimit\task;

use lazyperson0710\folivora\features\world_manager\database\WorldCategory;
use lazyperson0710\folivora\features\world_manager\WorldLimit\WorldProperty;
use lazyperson0710\folivora\util\message\send_message\SendMessage;
use pocketmine\scheduler\Task;
use pocketmine\Server;

class CheckLifeWorldTask extends Task {

    /** @var WorldProperty[] */
    private array $properties;

    /**
     * @param WorldProperty[] $properties
     */
    public function __construct(array $properties) {
        $this->properties = $properties;
    }

    /**
     * @inheritDoc
     */
    public function onRun() : void {
        foreach ($this->properties as $property) {
            $world = Server::getInstance()->getWorldManager()->getWorldByName($property->getWorldName());
            foreach ($world->getPlayers() as $player) {
                if (in_array($world->getFolderName(), WorldCategory::Nature, true) || in_array($world->getFolderName(), WorldCategory::MiningWorld, true) || in_array($world->getFolderName(), WorldCategory::Nether, true) || in_array($world->getFolderName(), WorldCategory::End, true)) return;
                if (!$property->inSafeArea($player->getPosition())) {
                    Server::getInstance()->dispatchCommand($player, 'warp lobby');
                    SendMessage::Send($player, '範囲外に行こうとする試みは許可されていません', 'WorldBorder', false);
                }
            }
        }
    }
}
