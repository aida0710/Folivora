<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\other;

use lazyperson0710\folivora\features\other\test\command\Test;
use lazyperson0710\folivora\features\other\test\listener\BreakListener;
use lazyperson0710\folivora\features\other\test\listener\JoinEventListener;
use lazyperson0710\folivora\util\plugin_base\IPluginBase;
use lazyperson0710\folivora\util\register\RegisterListener;
use lazyperson0710\folivora\util\register\RegisterTask;
use pocketmine\scheduler\ClosureTask;
use pocketmine\Server;

class Other implements IPluginBase {

    public function onEnable(Server $server) : void {
        RegisterListener::register(new BreakListener());
        RegisterListener::register(new JoinEventListener());
        RegisterTask::register()->scheduleRepeatingTask(new ClosureTask(
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
