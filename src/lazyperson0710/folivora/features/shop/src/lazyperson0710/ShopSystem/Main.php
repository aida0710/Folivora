<?php

declare(strict_types = 1);

namespace lazyperson0710\ShopSystem;

use lazyperson0710\ShopSystem\command\EffectShopCommand;
use lazyperson0710\ShopSystem\command\EnchantShopCommand;
use lazyperson0710\ShopSystem\command\InvSellCommand;
use lazyperson0710\ShopSystem\command\ShopCommand;
use lazyperson0710\ShopSystem\database\EffectShopAPI;
use lazyperson0710\ShopSystem\database\EnchantShopAPI;
use lazyperson0710\ShopSystem\database\ItemShopAPI;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase {

	protected function onEnable() : void {
		ItemShopAPI::getInstance()->init();
		EffectShopAPI::getInstance()->init();
		EnchantShopAPI::getInstance()->init();
		$this->getServer()->getCommandMap()->registerAll('shopSystem', [
			new ShopCommand(),
			new InvSellCommand(),
			new EnchantShopCommand(),
			new EffectShopCommand(),
		]);
	}
}
