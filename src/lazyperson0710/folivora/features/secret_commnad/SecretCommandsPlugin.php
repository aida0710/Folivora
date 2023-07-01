<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\secret_commnad;

use lazyperson0710\folivora\util\plugin_base\IPluginBase;
use lazyperson0710\folivora\util\register\RegisterListener;
use lazyperson0710\folivora\util\register\RegisterTaskScheduler;
use pocketmine\command\SimpleCommandMap;
use pocketmine\scheduler\ClosureTask;
use pocketmine\Server;

class SecretCommandsPlugin implements IPluginBase {

    /** @var Server */
    private static Server $server;

    /**
     * @param Server $server
     * @return void
     */
    public function onDisable(Server $server): void {
    }

    /**
     * @param Server $server
     * @return void
     */
    public function onEnable(Server $server): void {
        RegisterListener::register(new SendDataPackets());
        self::$server = $server;
        RegisterTaskScheduler::getScheduler()->scheduleDelayedTask(
            new ClosureTask(function (): void {
                self::disableCommand(self::$server->getCommandMap());
            }), 1,
        );
    }

    /**
     * @param SimpleCommandMap $commandMap
     * @return void
     */
    private function disableCommand(SimpleCommandMap $commandMap): void {
        foreach (CommandsList::DISABLE as $command) {
            $command = $commandMap->getCommand($command);
            if ($command === null) continue;
            $commandMap->unregister($command);
        }
    }

    /**
     * @return Server
     */
    public function getServer(): Server {
        return self::$server;
    }

}
