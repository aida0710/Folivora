<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\electronic_money;

use JsonException;
use lazyperson0710\folivora\features\electronic_money\command\MoneyCommand;
use lazyperson0710\folivora\features\electronic_money\currency\Money;
use lazyperson0710\folivora\features\electronic_money\listener\JoinEvent;
use lazyperson0710\folivora\util\config\exception\ConfigSaveException;
use lazyperson0710\folivora\util\plugin_base\IPluginBase;
use lazyperson0710\folivora\util\register\RegisterListener;
use pocketmine\Server;

class ElectronicMoney implements IPluginBase {

    /**
     * @param Server $server
     * @return void
     * @throws JsonException
     */
    public function onEnable(Server $server) : void {
        try {
            Money::getInstance()->createConfigFile();
        } catch (ConfigSaveException $exception) {
            $server->getLogger()->error($exception->getMessage());
        }
        Money::getInstance()->registerConfigClass();
        RegisterListener::register(new JoinEvent());
        $server->getCommandMap()->register(Money::PREFIX, new MoneyCommand());
    }

    public function onDisable(Server $server) : void {
    }

}
