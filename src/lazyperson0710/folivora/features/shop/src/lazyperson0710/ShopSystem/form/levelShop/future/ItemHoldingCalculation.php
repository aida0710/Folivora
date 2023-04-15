<?php

declare(strict_types = 1);

namespace lazyperson0710\ShopSystem\form\levelShop\future;

use lazyperson0710\ShopSystem\object\ShopItem;
use pocketmine\player\Player;
use pocketmine\utils\SingletonTrait;
use ree_jp\stackstorage\api\StackStorageAPI;

class ItemHoldingCalculation {

	use SingletonTrait;

	public function getHoldingCount(Player $player, ShopItem $item) : int {
		$count = 0;
		foreach ($player->getInventory()->getContents() as $inventoryItem) {
			if ($item->getItem() === $inventoryItem) {
				$count += $inventoryItem->getCount();
			}
		}
		return $count;
	}

	public function getVirtualStorageCount(Player $player, ShopItem $item) : int {
		StackStorageAPI::$instance->getCount($player->getXuid(), $item->getItem(),
			function ($count) {
				return $count;
			},
			function () {
				return 0;
			},
		);
		throw new \RuntimeException('This method must be called asynchronously.');
	}
}