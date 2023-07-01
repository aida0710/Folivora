<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\other;

use lazyperson0710\folivora\features\other\listener\CommandSign;
use lazyperson0710\folivora\features\other\overwrite\Override;
use lazyperson0710\folivora\features\other\register\enchant\Fortune;
use lazyperson0710\folivora\util\plugin_base\IPluginBase;
use lazyperson0710\folivora\util\register\RegisterListener;
use pocketmine\Server;

class Other implements IPluginBase {

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
        RegisterListener::register(new CommandSign());
        Override::init();
        Fortune::register();
    }

}
