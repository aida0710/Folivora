<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\form\item_shop\future;

use pocketmine\item\Item;
use pocketmine\player\Player;

class ItemHoldingCalculation {

    public static function getHoldingCount(Player $player, Item $targetItem) : int {
        $inventory = 0;
        for ($i = 0; $i <= 35; $i++) {
            $item = $player->getInventory()->getItem($i);
            if ($targetItem->equals($item)) {
                $inventory += $item->getCount();
            }
        }
        return $inventory;
    }

}
