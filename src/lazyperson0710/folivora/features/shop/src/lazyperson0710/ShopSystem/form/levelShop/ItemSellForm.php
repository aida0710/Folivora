<?php

declare(strict_types = 1);

namespace lazyperson0710\ShopSystem\form\levelShop;

use bbo51dog\bboform\form\CustomForm;
use lazyperson0710\ShopSystem\object\ShopItem;
use pocketmine\player\Player;

class ItemSellForm extends CustomForm {

	public function __construct(Player $player, ShopItem $item) {
	}
}
