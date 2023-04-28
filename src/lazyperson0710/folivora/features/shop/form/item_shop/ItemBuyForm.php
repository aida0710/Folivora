<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\form\item_shop;

use bbo51dog\bboform\form\CustomForm;
use lazyperson0710\folivora\features\shop\object\ItemShopObject;
use pocketmine\player\Player;

class ItemBuyForm extends CustomForm {

	public function __construct(Player $player, ItemShopObject $item) {
	}

}
