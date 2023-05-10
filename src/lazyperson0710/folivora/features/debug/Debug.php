<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\debug;

use lazyperson0710\folivora\features\debug\test\command\Test;
use lazyperson0710\folivora\features\debug\test\listener\BreakListener;
use lazyperson0710\folivora\features\debug\test\listener\JoinEventListener;
use lazyperson0710\folivora\util\plugin_base\IPluginBase;
use lazyperson0710\folivora\util\register\RegisterListener;
use lazyperson0710\folivora\util\register\RegisterTaskScheduler;
use pocketmine\scheduler\ClosureTask;
use pocketmine\Server;

class Debug implements IPluginBase {

    public function onEnable(Server $server) : void {
        RegisterListener::register(new BreakListener());
        RegisterListener::register(new JoinEventListener());
        RegisterTaskScheduler::getScheduler()->scheduleRepeatingTask(new ClosureTask(
            function () : void {
                Server::getInstance()->getLogger()->warning('リピート -> 1分経過しました');
            }
        ), 20 * 60,
        );
        $server->getCommandMap()->registerAll('testCommands', [
            new Test(),
        ]);
    }

    public function onDisable(Server $server) : void {
    }

}
