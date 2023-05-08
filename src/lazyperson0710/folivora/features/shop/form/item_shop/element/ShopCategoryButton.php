<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\form\item_shop\element;

use bbo51dog\bboform\element\Button;
use bbo51dog\bboform\element\ButtonImage;
use lazyperson0710\folivora\features\shop\form\item_shop\ItemSelectForm;
use lazyperson710\core\packet\SendForm;
use pocketmine\player\Player;

class ShopCategoryButton extends Button {

	private int $shopNumber;
	private string $category;

	public function __construct(string $text, int $restrictionLevel, string $category, ?ButtonImage $image = null) {
		parent::__construct($text, $image);
		$this->shopNumber = $restrictionLevel;
		$this->category = $category;
	}

	public function handleSubmit(Player $player) : void {
		SendForm::Send($player, new ItemSelectForm($this->shopNumber, $this->category));
	}
}