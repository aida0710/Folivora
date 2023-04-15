<?php

declare(strict_types = 1);

namespace lazyperson0710\ShopSystem\form\levelShop;

use bbo51dog\bboform\form\SimpleForm;
use lazyperson0710\ShopSystem\database\ItemShopAPI;
use lazyperson0710\ShopSystem\form\levelShop\element\SendMenuFormButton;
use lazyperson0710\ShopSystem\form\levelShop\future\RestrictionShop;
use lazyperson0710\ShopSystem\form\levelShop\future\ShopText;
use pocketmine\player\Player;

class ItemSelectForm extends SimpleForm implements ShopText {

	public function __construct(Player $player, int $shopNumber, string $category) {
		$shopItems = ItemShopAPI::getInstance()->getCategoryItems($shopNumber, $category);
		$restriction = RestrictionShop::getInstance()->getRestrictionByShopNumber($shopNumber);
		$this
			->setTitle(self::TITLE)
			->setText(self::CONTENT);
		foreach ($shopItems as $item) {
			if ($item->getSell() === 0) {
				$this->addElement(new SendMenuFormButton($item->getDisplayName() . PHP_EOL . '購入: ' . number_format($item->getBuy()) . '円 / 売却: 不可', new ItemBuyForm($player, $item), $restriction));
			} else {
				$this->addElement(new SendMenuFormButton($item->getDisplayName() . PHP_EOL . '購入: ' . number_format($item->getBuy()) . '円 / 売却: ' . number_format($item->getSell()) . '円', new SelectTypeForm($player, $item), $restriction));
			}
		}
		$this->addElement(new SendMenuFormButton('このカテゴリのアイテムを一括売却する', new BulkSaleForm($player, $shopNumber, $category), $restriction));
		$this->addElement(new SendMenuFormButton('カテゴリ選択メニューに戻る', new CategorySelectForm($player, $shopNumber), $restriction));
	}

}