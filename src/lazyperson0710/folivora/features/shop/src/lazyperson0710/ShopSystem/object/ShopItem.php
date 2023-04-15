<?php

declare(strict_types = 1);

namespace lazyperson0710\ShopSystem\object;

use pocketmine\item\Item;

class ShopItem {

	public function __construct(
		private Item $item,
		private int $buy,
		private int $sell,
		private int $shopId,
		private string $itemCategory,
		private string $displayName,
		private bool $workingItem,
	) {
	}

	public function getItem() : Item {
		return $this->item;
	}

	public function getBuy() : int {
		return $this->buy;
	}

	public function getSell() : int {
		return $this->sell;
	}

	public function getShopId() : int {
		return $this->shopId;
	}

	public function getItemCategory() : string {
		return $this->itemCategory;
	}

	public function getDisplayName() : string {
		return $this->displayName;
	}

	public function isWorkingItem() : bool {
		return $this->workingItem;
	}

}