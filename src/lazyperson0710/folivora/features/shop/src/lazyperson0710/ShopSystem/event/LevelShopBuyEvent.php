<?php

declare(strict_types = 1);

namespace lazyperson0710\ShopSystem\event;

use lazyperson0710\ShopSystem\object\LevelShopItem;
use pocketmine\event\Event;
use pocketmine\player\Player;

class LevelShopBuyEvent extends Event {

	public function __construct(
		private Player $player,
		private LevelShopItem $item,
	) {
	}

	public function getPlayer() : Player {
		return $this->player;
	}

	public function getItem() : LevelShopItem {
		return $this->item;
	}

}
