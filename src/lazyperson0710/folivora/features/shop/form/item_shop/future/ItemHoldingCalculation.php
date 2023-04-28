<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\form\item_shop\future;

use lazyperson0710\folivora\features\shop\object\ItemShopObject;
use pocketmine\player\Player;
use pocketmine\utils\SingletonTrait;
use ree_jp\stackstorage\api\StackStorageAPI;
use RuntimeException;

class ItemHoldingCalculation {

	use SingletonTrait;

	public function getHoldingCount(Player $player, ItemShopObject $item) : int {
		$count = 0;
		foreach ($player->getInventory()->getContents() as $inventoryItem) {
			if ($item->getItem() === $inventoryItem) {
				$count += $inventoryItem->getCount();
			}
		}
		return $count;
	}

	public function getVirtualStorageCount(Player $player, ItemShopObject $item) : int {
		StackStorageAPI::$instance->getCount($player->getXuid(), $item->getItem(),
			function ($count) {
				return $count;
			},
			function () {
				return 0;
			},
		);
		throw new RuntimeException('This method must be called asynchronously.');
	}
}
