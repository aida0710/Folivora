<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\util\plugin_base;

use pocketmine\Server;

interface IPluginBase {

    public function onEnable(Server $server): void;

    public function onDisable(Server $server): void;

}