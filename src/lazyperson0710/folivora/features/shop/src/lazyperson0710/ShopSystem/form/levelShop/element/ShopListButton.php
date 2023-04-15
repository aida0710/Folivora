<?php

declare(strict_types = 0);

namespace lazyperson0710\ShopSystem\form\levelShop\element;

use bbo51dog\bboform\element\Button;
use bbo51dog\bboform\element\ButtonImage;
use lazyperson710\core\packet\SendForm;
use pocketmine\player\Player;

class ShopListButton extends Button {

	private int $shopNumber;

	public function __construct(string $text, int $restrictionLevel, ?ButtonImage $image = null) {
		parent::__construct($text, $image);
		$this->shopNumber = $restrictionLevel;
	}

	public function handleSubmit(Player $player) : void {
		SendForm::Send($player,);
	}
}
