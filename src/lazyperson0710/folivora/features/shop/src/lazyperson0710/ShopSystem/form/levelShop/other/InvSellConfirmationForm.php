<?php

declare(strict_types = 1);

namespace lazyperson0710\ShopSystem\form\levelShop\other;

use bbo51dog\bboform\element\Button;
use bbo51dog\bboform\form\SimpleForm;
use lazyperson0710\ShopSystem\database\ItemShopAPI;
use lazyperson0710\ShopSystem\form\levelShop\future\ShopText;
use lazyperson0710\ShopSystem\form\levelShop\other\InvSell\LevelShopAPI;
use lazyperson710\core\packet\SendForm;
use lazyperson710\core\packet\SendMessage\SendMessage;
use pocketmine\item\ItemIds;
use pocketmine\player\Player;
use function is_null;

class InvSellConfirmationForm extends SimpleForm implements ShopText {

	private string $allItems;
	private string $insufficientLevelAllItem;
	private int $allCount;
	private int $allSellMoney;
	private int $insufficientLevelAllCount;

	public function __construct() {
		$this
			->setTitle('Level Shop')
			->setText('inventory内のアイテムを一括売却します' . PHP_EOL . PHP_EOL . '売却値が0円のアイテムや解放されていないアイテム(レベル不足)は売却されません')
			->addElements(new Button('確認画面に進む'));
	}

	public function handleSubmit(Player $player) : void {
		$inventory = $player->getInventory();
		for ($i = 0, $size = $inventory->getSize(); $i < $size; ++$i) {
			$item = clone $inventory->getItem($i);
			if ($item->getId() == ItemIds::AIR) continue;
			if (ItemShopAPI::getInstance()->get())
				if (LevelShopAPI::getInstance()->getSell($item->getId(), $item->getMeta()) == 0) continue;
			if (LevelShopAPI::getInstance()->checkLevel($player, $item->getId(), $item->getMeta()) === 'failure') {
				$insufficientLevelAllCount += $item->getCount();
				$insufficientLevelAllItem .= $item->getName() . " x{$item->getCount()}\n";
				continue;
			} elseif (LevelShopAPI::getInstance()->checkLevel($player, $item->getId(), $item->getMeta()) === 'exception') continue;
			$count = $item->getCount();
			$sellMoney = LevelShopAPI::getInstance()->getSell($item->getId(), $item->getMeta());
			$sellMoney = $sellMoney * $count;
			$allSellMoney += $sellMoney;
			$allCount += $item->getCount();
			$allItem .= $item->getName() . " x{$count}\n";
		}
		if (is_null($allItem)) {
			SendMessage::Send($player, '売却できるアイテムが存在しません', 'LevelShop', true, 'dig.chain');
			return;
		}
		if (is_null($insufficientLevelAllItem)) {
			$insufficientLevelAllItem .= "none\n";
		}
		SendForm::Send($player, (new InvSellResultForm($allCount, $allSellMoney, $allItem, $insufficientLevelAllCount, $insufficientLevelAllItem)));
	}
}
