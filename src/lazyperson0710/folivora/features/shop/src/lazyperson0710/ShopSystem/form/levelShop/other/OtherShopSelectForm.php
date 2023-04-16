<?php

declare(strict_types = 1);

namespace lazyperson0710\ShopSystem\form\levelShop\other;

use bbo51dog\bboform\form\SimpleForm;
use lazyperson0710\ShopSystem\form\levelShop\element\FirstBackFormButton;
use lazyperson0710\ShopSystem\form\levelShop\element\SendMenuFormButton;
use lazyperson0710\ShopSystem\form\levelShop\future\RestrictionShop;
use lazyperson0710\ShopSystem\form\levelShop\future\ShopText;

class OtherShopSelectForm extends SimpleForm implements ShopText {

	public function __construct() {
		$this
			->setTitle(self::TITLE)
			->setText(self::CONTENT)
			->addElements(
				new SendMenuFormButton("Inventory内のアイテムを一括売却 [ID: invsell]\nツールや売却値が0円のアイテムは対象外", new InvSellConfirmationForm(), RestrictionShop::RESTRICTION_LEVEL_OTHER_SHOP),
				new SendMenuFormButton("アイテムを検索 [ID: search]\n表示されてる名前で検索が可能です(日本語)", new SearchItemForm(), RestrictionShop::RESTRICTION_LEVEL_OTHER_SHOP),
				new FirstBackFormButton('ショップ選択メニューに戻る'),
			);
	}
}
