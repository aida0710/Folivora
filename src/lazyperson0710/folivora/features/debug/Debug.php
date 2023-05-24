<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\debug;

use lazyperson0710\folivora\features\debug\test\listener\LEvent;
use lazyperson0710\folivora\util\plugin_base\IPluginBase;
use lazyperson0710\folivora\util\register\RegisterListener;
use pocketmine\Server;

class Debug implements IPluginBase {

    public function onEnable(Server $server) : void {
        RegisterListener::register(new LEvent());
    }

    public function onDisable(Server $server) : void {
    }

}
