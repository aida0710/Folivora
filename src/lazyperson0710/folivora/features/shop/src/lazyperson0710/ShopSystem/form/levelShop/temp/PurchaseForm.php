<?php

declare(strict_types = 0);

namespace lazyperson0710\ShopSystem\form\levelShop\temp;

use lazyperson0710\ShopSystem\database\LevelShopAPI;
use lazyperson0710\ShopSystem\event\LevelShopSellEvent;
use lazyperson0710\ShopSystem\object\LevelShopItem;
use lazyperson710\core\packet\SendMessage\SendMessage;
use onebone\economyapi\EconomyAPI;
use pocketmine\form\Form;
use pocketmine\player\Player;
use ree_jp\stackStorage\api\StackStorageAPI;
use function ctype_digit;
use function floor;
use function number_format;
use function strval;

class PurchaseForm implements Form {

	private LevelShopAPI $api;

	public function __construct(
		private LevelShopItem $item,
	) {
		$this->api = LevelShopAPI::getInstance();
	}

	public function handleResponse(Player $player, $data) : void {
		$itemName = $this->api->getItemName($this->item->getItem()->getId(), $this->item->getItem()->getMeta());
		if ($data === null || $data[1] === null) {
			SendMessage::Send($player, $itemName . 'の購入をキャンセルしました', 'LevelShop', true, 'dig.chain');
			return;
		}
		if ($data[1] === '' || !$this->isInteger($data[1]) || (int) floor($data[1]) <= 0) {
			SendMessage::Send($player, '1以上の整数を入力してください', 'LevelShop', false, 'dig.chain');
			return;
		}
		$count = (int) floor($data[1]);
		$totalPrice = $this->item->getPrice() * $count; //1 = 変数名、衝突対策...
		$result = $totalPrice - $this->item->getMyMoney();
		if ($this->item->getMyMoney() < $totalPrice) {
			SendMessage::Send($player, 'お金が' . number_format($result) . '円足りませんでした。合計必要金額:' . number_format($totalPrice) . '円', 'LevelShop', false, 'dig.chain');
			return;
		}
		$this->item->getItem()->setCount($count);
		if ($data[2] === true) {
			EconomyAPI::getInstance()->reduceMoney($player, $this->item->getPrice() * $count);
			StackStorageAPI::$instance->add($player->getXuid(), $this->item->getItem());
			$totalPrice = $this->item->getPrice() * $count;
			SendMessage::Send($player, $itemName . 'を' . number_format($count) . '個購入し、仮想ストレージに転送しました。使用金額 : ' . number_format($totalPrice) . '円', 'LevelShop', true, 'break.amethyst_block');
			return;
		}
		if (!$player->getInventory()->canAddItem($this->item->getItem())) {
			SendMessage::Send($player, 'インベントリに空きはありません', 'LevelShop', false, 'dig.chain');
			return;
		}
		$player->getInventory()->addItem($this->item->getItem());
		EconomyAPI::getInstance()->reduceMoney($player, $this->item->getPrice() * $count);
		$totalPrice = $this->item->getPrice() * $count;
		SendMessage::Send($player, $itemName . 'を' . number_format($count) . '個購入しました。使用金額 : ' . number_format($totalPrice) . '円', 'LevelShop', true, 'break.amethyst_block');
		(new LevelShopSellEvent($player, $this->item, 'buy'))->call();
	}

	private function isInteger($input) : bool {
		return (ctype_digit(strval($input)));
	}

	public function jsonSerialize() {
		return [
			'type' => 'custom_form',
			'title' => 'LevelShop',
			'content' => [
				[
					'type' => 'label',
					'text' => "購入するアイテム/{$this->api->getItemName($this->item->getItem()->getId(),$this->item->getItem()->getMeta())}
                    \n1つあたりの値段/" . number_format($this->item->getPrice()) . "
                    \n仮想ストレージにある量/" . number_format($this->item->getStorage()) . "
                    \nインベントリにある数/" . number_format($this->item->getCount()) . "
                    \n現在の所持金/" . number_format($this->item->getMyMoney()),
				],
				[
					'type' => 'input',
					'text' => '個数を入力',
					'placeholder' => '個数を入力してください',
					'default' => '',
				],
				[
					'type' => 'toggle',
					'text' => '仮想ストレージに転送',
				],
			],
		];
	}
}
