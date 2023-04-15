<?php

declare(strict_types = 0);

namespace lazyperson0710\ShopSystem\object;

use pocketmine\item\Item;

class LevelShopItem {

	public function __construct(
		private Item $item,
		private int $price,
		private int $count,
		private int $myMoney,
		private int $storage,
	) {
	}

	public function getItem() : Item {
		return $this->item;
	}

	public function getPrice() : int {
		return $this->price;
	}

	public function getCount() : int {
		return $this->count;
	}

	public function getMyMoney() : int {
		return $this->myMoney;
	}

	public function getStorage() : int {
		return $this->storage;
	}

	public function setStorage(int $storage) : void {
		$this->storage = $storage;
	}

}
