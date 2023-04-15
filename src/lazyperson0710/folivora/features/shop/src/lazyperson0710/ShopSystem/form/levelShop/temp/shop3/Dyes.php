<?php

declare(strict_types = 0);

namespace lazyperson0710\ShopSystem\form\levelShop\temp\shop3;

use bbo51dog\bboform\form\SimpleForm;
use lazyperson0710\ShopSystem\form\levelShop\temp\Calculation;
use lazyperson710\core\packet\SendForm;
use lazyperson710\core\packet\SoundPacket;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use function basename;

class Dyes extends SimpleForm {

	private string $shopNumber;
	private array $contents;

	public function __construct(Player $player) {
		$this->shopNumber = basename(__DIR__);
		$this->contents = [
			VanillaItems::WHITE_DYE(),
			VanillaItems::LIGHT_GRAY_DYE(),
			VanillaItems::GRAY_DYE(),
			VanillaItems::BLACK_DYE(),
			VanillaItems::BROWN_DYE(),
			VanillaItems::RED_DYE(),
			VanillaItems::ORANGE_DYE(),
			VanillaItems::YELLOW_DYE(),
			VanillaItems::LIME_DYE(),
			VanillaItems::GREEN_DYE(),
			VanillaItems::CYAN_DYE(),
			VanillaItems::LIGHT_BLUE_DYE(),
			VanillaItems::BLUE_DYE(),
			VanillaItems::PURPLE_DYE(),
			VanillaItems::MAGENTA_DYE(),
			VanillaItems::PINK_DYE(),
		];
		Calculation::getInstance()->sendButton($player, $this->shopNumber, $this->contents, $this);
	}

	public function handleClosed(Player $player) : void {
		SoundPacket::Send($player, 'mob.shulker.close');
		SendForm::Send($player, Calculation::getInstance()->secondBackFormClass($this->shopNumber));
	}
}
