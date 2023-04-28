<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\form\item_shop\other;

use bbo51dog\bboform\element\Button;
use bbo51dog\bboform\form\SimpleForm;
use lazyperson0710\folivora\features\shop\form\item_shop\future\ShopText;
use lazyperson0710\ShopSystem\form\levelShop\other\InvSell\LevelShopAPI;
use lazyperson710\core\packet\SendMessage\SendMessage;
use onebone\economyapi\EconomyAPI;
use pocketmine\item\ItemIds;
use pocketmine\player\Player;

class InvSellResultForm extends SimpleForm implements ShopText {

	public function __construct(int $allCount, int $allSellMoney, string $allItem, int $insufficientLevelAllCount, string $insufficientLevelAllItem) {
		$this
			->setTitle(self::TITLE)
			->setText("下記のアイテムを売却しても本当によろしいでしょうか？\n\n売却合計金額 {$allSellMoney}円\n売却アイテム合計数 {$allCount}個\n\n売却アイテム一覧\n{$allItem}\nレベル不足で売却ができないアイテム合計数 {$insufficientLevelAllCount}個\nレベル不足で売却ができないアイテム一覧\n{$insufficientLevelAllItem}")
			->addElement(new Button('はい'));
	}

	public function handleSubmit(Player $player) : void {
		$inventory = $player->getInventory();
		$allCount = 0;
		$allSellMoney = 0;
		for ($i = 0, $size = $inventory->getSize(); $i < $size; ++$i) {
			$item = clone $inventory->getItem($i);
			if ($item->getId() == ItemIds::AIR) continue;
			if (LevelShopAPI::getInstance()->getSell($item->getId(), $item->getMeta()) == 0) continue;
			if (LevelShopAPI::getInstance()->checkLevel($player, $item->getId(), $item->getMeta()) === 'failure') {
				continue;
			} elseif (LevelShopAPI::getInstance()->checkLevel($player, $item->getId(), $item->getMeta()) === 'exception') continue;
			$sellMoney = LevelShopAPI::getInstance()->getSell($item->getId(), $item->getMeta());
			$count = $item->getCount();
			$sellMoney = $sellMoney * $count;
			$allCount += $item->getCount();
			$allSellMoney += $sellMoney;
			$inventory->removeItem($item);
		}
		EconomyAPI::getInstance()->addMoney($player->getName(), $allSellMoney);
		SendMessage::Send($player, "{$allSellMoney}円で{$allCount}個のアイテムが売却されました", 'LevelShop', true, 'break.amethyst_block');
	}
}
