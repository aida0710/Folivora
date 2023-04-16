<?php

declare(strict_types = 1);

namespace lazyperson0710\ShopSystem\form\levelShop\temp;

use lazyperson0710\ShopSystem\database\LevelShopAPI;
use lazyperson0710\ShopSystem\object\LevelShopItem;
use lazyperson710\core\packet\SendForm;
use onebone\economyapi\EconomyAPI;
use pocketmine\form\Form;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\player\Player;
use ree_jp\stackStorage\api\StackStorageAPI;
use function number_format;

class SellBuyForm implements Form {

	private int $itemId;
	private int $itemMeta;
	private int $buy;
	private int $sell;

	public function __construct(int $itemId, int $itemMeta, int $buy, int $sell) {
		$this->itemId = $itemId;
		$this->itemMeta = $itemMeta;
		$this->buy = $buy;
		$this->sell = $sell;
	}

	public function handleResponse(Player $player, $data) : void {
		if ($data === null) {
			return;
		}
		$item = ItemFactory::getInstance()->get($this->itemId, $this->itemMeta);
		StackStorageAPI::$instance->getCount($player->getXuid(), $item, function ($count) use ($player, $item, $data) {
			$this->callback($player, $item, $data, $count);
		}, function () use ($player, $item, $data) {
			$this->callback($player, $item, $data, 0);
		});
	}

	public function callback(Player $player, Item $item, bool $data, int $storage) : void {
		$count = 0;
		$myMoney = (int) EconomyAPI::getInstance()->mymoney($player);
		foreach ($player->getInventory()->getContents() as $v) {
			if ($item->getId() === $v->getId() && $item->getMeta() === $v->getMeta()) {
				$count += $v->getCount();
			}
		}
		if ($data) {
			SendForm::Send($player, (new PurchaseForm(new LevelShopItem($item, $this->buy, $count, $myMoney, $storage))));
			return;
		}
		SendForm::Send($player, (new SaleForm(new LevelShopItem($item, $this->sell, $count, $myMoney, $storage))));
	}

	public function jsonSerialize() {
		$api = LevelShopAPI::getInstance();
		$notWorkingItem = null;
		if (LevelShopAPI::getInstance()->getWorkingBlock($this->itemId, $this->itemMeta) === false) {
			$notWorkingItem = "\n§cこのアイテムは装飾品の為動作しません§r";
		}
		$buyPrice = number_format($this->buy);
		$sellPrice = number_format($this->sell);
		return [
			'type' => 'modal',
			'title' => 'LevelShop',
			'content' => "購入か売却かを選択してください\n選択したアイテム : {$api->getItemName($this->itemId, $this->itemMeta)}{$notWorkingItem}\n\n一つ当たりの購入値 : {$buyPrice}円\n一つ当たりの売却値 : {$sellPrice}円",
			'button1' => '購入する',
			'button2' => '売却する',
		];
	}
}
