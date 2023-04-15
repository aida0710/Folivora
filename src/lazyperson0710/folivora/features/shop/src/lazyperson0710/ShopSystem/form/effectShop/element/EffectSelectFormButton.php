<?php

declare(strict_types = 0);

namespace lazyperson0710\ShopSystem\form\effectShop\element;

use bbo51dog\bboform\element\Button;
use bbo51dog\bboform\element\ButtonImage;
use lazyperson0710\ShopSystem\form\effectShop\EffectConfirmationForm;
use lazyperson710\core\packet\SendForm;
use pocketmine\entity\effect\Effect;
use pocketmine\player\Player;

class EffectSelectFormButton extends Button {

	private Effect $effect;

	public function __construct(string $text, Effect $effect, ?ButtonImage $image = null) {
		parent::__construct($text, $image);
		$this->effect = $effect;
	}

	public function handleSubmit(Player $player) : void {
		SendForm::Send($player, (new EffectConfirmationForm($player, $this->effect)));
	}
}
