<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\util\register;

use lazyperson0710\folivora\features\other\Other;
use lazyperson0710\folivora\util\plugin_base\DummyPluginBase;
use lazyperson0710\folivora\util\plugin_base\IPluginBase;
use pocketmine\Server;

class RegisterFeatures {

    public static function enableFeatures(Server $server) : void {
        $class = [
            new Other(),
        ];
        foreach ($class as $pluginBase) {
            if ($pluginBase instanceof IPluginBase) {
                (new RegisterFeatures)->register($pluginBase, $server);
            } else {
                throw new \RuntimeException("Class must be instance of IPluginBase.");
            }
        }
    }

    private function register(IPluginBase $pluginBase, Server $server) : void {
        $pluginBase->onEnable($server);
        $pluginBase->onDisable($server);
    }

}
