<?php

declare(strict_types = 0);

namespace lazyperson0710\ShopSystem\form\levelShop\temp\shop1;

use bbo51dog\bboform\form\SimpleForm;
use lazyperson0710\ShopSystem\form\levelShop\temp\Calculation;
use lazyperson710\core\packet\SendForm;
use lazyperson710\core\packet\SoundPacket;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use function basename;

class Tools extends SimpleForm {

	private string $shopNumber;
	private array $contents;

	public function __construct(Player $player) {
		$this->shopNumber = basename(__DIR__);
		$this->contents = [
			VanillaItems::IRON_PICKAXE(),
			VanillaItems::IRON_SHOVEL(),
			VanillaItems::IRON_AXE(),
			VanillaItems::DIAMOND_PICKAXE(),
			VanillaItems::DIAMOND_SHOVEL(),
			VanillaItems::DIAMOND_AXE(),
			VanillaItems::SHEARS(),
		];
		Calculation::getInstance()->sendButton($player, $this->shopNumber, $this->contents, $this);
	}

	public function handleClosed(Player $player) : void {
		SoundPacket::Send($player, 'mob.shulker.close');
		SendForm::Send($player, Calculation::getInstance()->secondBackFormClass($this->shopNumber));
	}
}
