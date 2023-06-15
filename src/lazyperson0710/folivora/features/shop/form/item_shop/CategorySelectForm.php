<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\form\item_shop;

use bbo51dog\bboform\form\SimpleForm;
use lazyperson0710\folivora\features\shop\database\ItemShopAPI;
use lazyperson0710\folivora\features\shop\form\item_shop\element\FirstBackFormButton;
use lazyperson0710\folivora\features\shop\form\item_shop\element\SendItemSelectFormButton;
use lazyperson0710\folivora\features\shop\form\item_shop\future\FormText;
use lazyperson0710\folivora\features\shop\form\item_shop\future\RestrictionShop;
use lazyperson0710\folivora\features\shop\form\item_shop\future\ShopCategory;

class CategorySelectForm extends SimpleForm {

    public function __construct(int $shopNumber) {
        $shopCategory = array_keys(ItemShopAPI::getInstance()->getCategory($shopNumber));
        $restriction = RestrictionShop::getInstance()->getRestrictionByShopNumber($shopNumber);
        $this
            ->setTitle(FormText::TITLE)
            ->setText('コンテンツを選択してください');
        foreach ($shopCategory as $category) {
            $displayName = ShopCategory::getInstance()->getCategoryByDisplayName($category);
            $this->addElement(new SendItemSelectFormButton($displayName, $shopNumber, $category, $restriction));
        }
        $this->addElement(new FirstBackFormButton('ショップ選択メニューに戻る'));
    }

}
