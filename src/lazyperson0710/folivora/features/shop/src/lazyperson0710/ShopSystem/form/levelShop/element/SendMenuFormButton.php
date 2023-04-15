<?php

declare(strict_types = 0);

namespace lazyperson0710\ShopSystem\form\levelShop\element;

use bbo51dog\bboform\element\Button;
use bbo51dog\bboform\element\ButtonImage;
use bbo51dog\bboform\form\FormBase;
use lazyperson0710\ShopSystem\form\levelShop\future\LevelCheck;
use pocketmine\player\Player;

class SendMenuFormButton extends Button {

	private FormBase $form;
	private int $restrictionLevel;

	public function __construct(string $text, FormBase $form, int $restrictionLevel, ?ButtonImage $image = null) {
		parent::__construct($text, $image);
		$this->form = $form;
		$this->restrictionLevel = $restrictionLevel;
	}

	public function handleSubmit(Player $player) : void {
		LevelCheck::getInstance()->check($player, $this->form, $this->restrictionLevel);
	}
}
