<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop;

use lazyperson0710\folivora\features\shop\command\EffectShopCommand;
use lazyperson0710\folivora\features\shop\command\EnchantShopCommand;
use lazyperson0710\folivora\features\shop\command\ItemShopCommand;
use lazyperson0710\folivora\features\shop\database\EffectShopAPI;
use lazyperson0710\folivora\features\shop\database\EnchantShopAPI;
use lazyperson0710\folivora\features\shop\database\ItemShopAPI;
use pocketmine\plugin\PluginBase;

class Shop {

    public function init(PluginBase $base) : void {
        ItemShopAPI::getInstance()->init();
        EffectShopAPI::getInstance()->init();
        EnchantShopAPI::getInstance()->init();
        $base->getServer()->getCommandMap()->registerAll('shopSystem', [
            new ItemShopCommand(),
            new EnchantShopCommand(),
            new EffectShopCommand(),
        ]);
    }
}
