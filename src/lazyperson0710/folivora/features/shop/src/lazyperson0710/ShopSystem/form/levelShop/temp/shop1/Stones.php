<?php

declare(strict_types = 0);

namespace lazyperson0710\ShopSystem\form\levelShop\temp\shop1;

use bbo51dog\bboform\form\SimpleForm;
use lazyperson0710\ShopSystem\form\levelShop\temp\Calculation;
use lazyperson710\core\packet\SendForm;
use lazyperson710\core\packet\SoundPacket;
use pocketmine\block\VanillaBlocks;
use pocketmine\player\Player;
use function basename;

class Stones extends SimpleForm {

	private string $shopNumber;
	private array $contents;

	public function __construct(Player $player) {
		$this->shopNumber = basename(__DIR__);
		$this->contents = [
			VanillaBlocks::DIRT()->asItem(),
			VanillaBlocks::STONE()->asItem(),
			VanillaBlocks::COBBLESTONE()->asItem(),
			VanillaBlocks::GRANITE()->asItem(),
			VanillaBlocks::DIORITE()->asItem(),
			VanillaBlocks::ANDESITE()->asItem(),
			VanillaBlocks::SAND()->asItem(),
			VanillaBlocks::SANDSTONE()->asItem(),
			VanillaBlocks::GRAVEL()->asItem(),
		];
		Calculation::getInstance()->sendButton($player, $this->shopNumber, $this->contents, $this);
	}

	public function handleClosed(Player $player) : void {
		SoundPacket::Send($player, 'mob.shulker.close');
		SendForm::Send($player, Calculation::getInstance()->secondBackFormClass($this->shopNumber));
	}
}
