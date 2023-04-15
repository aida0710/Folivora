<?php

declare(strict_types = 0);

namespace lazyperson0710\ShopSystem\form\levelShop\temp\shop4;

use bbo51dog\bboform\form\SimpleForm;
use lazyperson0710\ShopSystem\form\levelShop\temp\Calculation;
use lazyperson710\core\packet\SendForm;
use lazyperson710\core\packet\SoundPacket;
use pocketmine\block\VanillaBlocks;
use pocketmine\player\Player;
use function basename;

class OtherBlocks4 extends SimpleForm {

	private string $shopNumber;
	private array $contents;

	public function __construct(Player $player) {
		$this->shopNumber = basename(__DIR__);
		$this->contents = [
			VanillaBlocks::GRASS()->asItem(),
			VanillaBlocks::PODZOL()->asItem(),
			VanillaBlocks::MYCELIUM()->asItem(),
			VanillaBlocks::MOSSY_COBBLESTONE()->asItem(),
			VanillaBlocks::SMOOTH_STONE()->asItem(),
			VanillaBlocks::SMOOTH_QUARTZ()->asItem(),
			VanillaBlocks::SMOOTH_SANDSTONE()->asItem(),
			VanillaBlocks::SMOOTH_RED_SANDSTONE()->asItem(),
		];
		Calculation::getInstance()->sendButton($player, $this->shopNumber, $this->contents, $this);
	}

	public function handleClosed(Player $player) : void {
		SoundPacket::Send($player, 'mob.shulker.close');
		SendForm::Send($player, Calculation::getInstance()->secondBackFormClass($this->shopNumber));
	}
}
