<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\command;

use lazyperson0710\folivora\features\shop\form\item_shop\CategorySelectForm;
use lazyperson0710\folivora\features\shop\form\item_shop\future\LevelCheck;
use lazyperson0710\folivora\features\shop\form\item_shop\future\RestrictionShop;
use lazyperson0710\folivora\features\shop\form\item_shop\other\InvSellConfirmationForm;
use lazyperson0710\folivora\features\shop\form\item_shop\other\OtherShopSelectForm;
use lazyperson0710\folivora\features\shop\form\item_shop\other\SearchItemForm;
use lazyperson0710\folivora\features\shop\form\item_shop\ShopSelectForm;
use lazyperson710\core\packet\SendForm;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use RuntimeException;

class ItemShopCommand extends Command {

	public function __construct() {
		parent::__construct('shop', 'ItemShopを開きます - /shop [shopID]');
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args) : void {
		if (!($sender instanceof Player)) {
			$sender->sendMessage('サーバー内で実行してください');
			return;
		}
		match ($args[0]) {
			'other' => LevelCheck::getInstance()->check($sender, new OtherShopSelectForm(), RestrictionShop::RESTRICTION_LEVEL_OTHER_SHOP),
			'search' => LevelCheck::getInstance()->check($sender, new SearchItemForm(), RestrictionShop::RESTRICTION_LEVEL_OTHER_SHOP),
			'invsell' => LevelCheck::getInstance()->check($sender, new InvSellConfirmationForm(), RestrictionShop::RESTRICTION_LEVEL_OTHER_SHOP),
			'1' => LevelCheck::getInstance()->check($sender, new CategorySelectForm($sender, 1), RestrictionShop::RESTRICTION_LEVEL_SHOP_1),
			'2' => LevelCheck::getInstance()->check($sender, new CategorySelectForm($sender, 2), RestrictionShop::RESTRICTION_LEVEL_SHOP_2),
			'3' => LevelCheck::getInstance()->check($sender, new CategorySelectForm($sender, 3), RestrictionShop::RESTRICTION_LEVEL_SHOP_3),
			'4' => LevelCheck::getInstance()->check($sender, new CategorySelectForm($sender, 4), RestrictionShop::RESTRICTION_LEVEL_SHOP_4),
			'5' => LevelCheck::getInstance()->check($sender, new CategorySelectForm($sender, 5), RestrictionShop::RESTRICTION_LEVEL_SHOP_5),
			'6' => LevelCheck::getInstance()->check($sender, new CategorySelectForm($sender, 6), RestrictionShop::RESTRICTION_LEVEL_SHOP_6),
			'7' => LevelCheck::getInstance()->check($sender, new CategorySelectForm($sender, 7), RestrictionShop::RESTRICTION_LEVEL_SHOP_7),
			default => SendForm::Send($sender, new ShopSelectForm($sender)),
		};
		throw new RuntimeException('Invalid shop number');
	}
}
