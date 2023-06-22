<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\command;

use lazyperson0710\folivora\features\shop\form\item_shop\CategorySelectForm;
use lazyperson0710\folivora\features\shop\form\item_shop\future\LevelCheck;
use lazyperson0710\folivora\features\shop\form\item_shop\future\RestrictionShop;
use lazyperson0710\folivora\features\shop\form\item_shop\other\InvSellForm;
use lazyperson0710\folivora\features\shop\form\item_shop\other\OtherShopSelectForm;
use lazyperson0710\folivora\features\shop\form\item_shop\other\search\SearchItemForm;
use lazyperson0710\folivora\features\shop\form\item_shop\ShopSelectForm;
use lazyperson0710\folivora\util\packet\SendForm;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class ItemShopCommand extends Command {

    public function __construct() {
        parent::__construct('shop', 'ItemShopを開きます - /shop [shopID]');
    }

    /**
     * @param CommandSender $sender
     * @param string        $commandLabel
     * @param array         $args
     * @return void
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if (!($sender instanceof Player)) {
            $sender->sendMessage('サーバー内で実行してください');
            return;
        }
        if (!isset($args[0])) {
            $sender->sendForm(new ShopSelectForm($sender));
            return;
        }
        match ($args[0]) {
            'other' => LevelCheck::sendForm($sender, new OtherShopSelectForm($sender), RestrictionShop::RESTRICTION_LEVEL_OTHER_SHOP),
            'search' => LevelCheck::sendForm($sender, new SearchItemForm(), RestrictionShop::RESTRICTION_LEVEL_OTHER_SHOP),
            'invsell' => LevelCheck::sendForm($sender, new InvSellForm($sender), RestrictionShop::RESTRICTION_LEVEL_OTHER_SHOP),
            '1' => LevelCheck::sendForm($sender, new CategorySelectForm(1), RestrictionShop::RESTRICTION_LEVEL_SHOP_1),
            '2' => LevelCheck::sendForm($sender, new CategorySelectForm(2), RestrictionShop::RESTRICTION_LEVEL_SHOP_2),
            '3' => LevelCheck::sendForm($sender, new CategorySelectForm(3), RestrictionShop::RESTRICTION_LEVEL_SHOP_3),
            '4' => LevelCheck::sendForm($sender, new CategorySelectForm(4), RestrictionShop::RESTRICTION_LEVEL_SHOP_4),
            '5' => LevelCheck::sendForm($sender, new CategorySelectForm(5), RestrictionShop::RESTRICTION_LEVEL_SHOP_5),
            '6' => LevelCheck::sendForm($sender, new CategorySelectForm(6), RestrictionShop::RESTRICTION_LEVEL_SHOP_6),
            '7' => LevelCheck::sendForm($sender, new CategorySelectForm(7), RestrictionShop::RESTRICTION_LEVEL_SHOP_7),
            default => SendForm::Send($sender, new ShopSelectForm($sender)),
        };
    }
}
