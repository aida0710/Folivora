<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\object;

use pocketmine\item\Item;

class ItemShopObject {

    public function __construct(
        private readonly Item $item,
        private readonly int $buy,
        private readonly int $sell,
        private readonly int $shopId,
        private readonly string $itemCategory,
        private readonly string $displayName,
        private readonly bool $workingItem,
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
