<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\form\item_shop;

use bbo51dog\bboform\form\SimpleForm;
use lazyperson0710\folivora\features\shop\database\ItemShopAPI;
use lazyperson0710\folivora\features\shop\form\item_shop\element\FirstBackFormButton;
use lazyperson0710\folivora\features\shop\form\item_shop\element\SendMenuFormButton;
use lazyperson0710\folivora\features\shop\form\item_shop\future\RestrictionShop;
use lazyperson0710\folivora\features\shop\form\item_shop\future\ShopCategory;
use lazyperson0710\folivora\features\shop\form\item_shop\future\ShopText;
use pocketmine\player\Player;
use function array_keys;

class CategorySelectForm extends SimpleForm implements ShopText {

    public function __construct(Player $player, int $shopNumber) {
        $shopCategory = array_keys(ItemShopAPI::getInstance()->getCategory($shopNumber));
        $restriction = RestrictionShop::getInstance()->getRestrictionByShopNumber($shopNumber);
        $this
            ->setTitle(self::TITLE)
            ->setText(self::CONTENT);
        foreach ($shopCategory as $category) {
            $displayName = ShopCategory::getInstance()->getCategoryByDisplayName($category);
            $this->addElement(new SendMenuFormButton($displayName, new ItemSelectForm($player, $shopNumber, $category), $restriction));
        }
        $this->addElement(new FirstBackFormButton('ショップ選択メニューに戻る'));
    }

}
