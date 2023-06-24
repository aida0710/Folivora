<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\secret_commnad;

use lazyperson0710\folivora\features\other\listener\CommandSign;
use lazyperson0710\folivora\util\plugin_base\IPluginBase;
use lazyperson0710\folivora\util\register\RegisterListener;
use lazyperson0710\folivora\util\register\RegisterTaskScheduler;
use pocketmine\command\SimpleCommandMap;
use pocketmine\scheduler\ClosureTask;
use pocketmine\Server;

class SecretCommandsPlugin implements IPluginBase {

    public function onDisable(Server $server): void {
    }

    public function onEnable(Server $server): void {
        RegisterListener::register(new CommandSign());
        RegisterTaskScheduler::getScheduler()->scheduleDelayedTask(
            new ClosureTask(function ($server): void {
                self::disableCommand($server->getCommandMap());
            }), 1,
        );
    }

    private function disableCommand(SimpleCommandMap $commandMap): void {
        foreach (CommandsList::DISABLE as $command) {
            $command = $commandMap->getCommand($command);
            if ($command === null) continue;
            $commandMap->unregister($command);
        }
    }

}
