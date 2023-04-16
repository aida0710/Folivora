<?php

declare(strict_types = 1);

namespace lazyperson0710\ShopSystem\form\levelShop\element;

use bbo51dog\bboform\element\Button;
use bbo51dog\bboform\element\ButtonImage;
use lazyperson0710\ShopSystem\form\levelShop\ShopSelectForm;
use lazyperson710\core\packet\SendForm;
use lazyperson710\core\packet\SoundPacket;
use pocketmine\player\Player;

class FirstBackFormButton extends Button {

	public function __construct(string $text, ?ButtonImage $image = null) {
		parent::__construct($text, $image);
	}

	public function handleSubmit(Player $player) : void {
		SoundPacket::Send($player, 'mob.shulker.close');
		SendForm::Send($player, (new ShopSelectForm($player)));
	}
}
