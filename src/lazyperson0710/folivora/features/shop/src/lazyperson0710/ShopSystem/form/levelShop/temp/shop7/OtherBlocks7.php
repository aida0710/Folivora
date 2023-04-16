<?php

declare(strict_types = 1);

namespace lazyperson0710\ShopSystem\form\levelShop\temp\shop7;

use bbo51dog\bboform\form\SimpleForm;
use lazyperson0710\ShopSystem\form\levelShop\temp\Calculation;
use lazyperson710\core\packet\SendForm;
use lazyperson710\core\packet\SoundPacket;
use pocketmine\block\VanillaBlocks;
use pocketmine\player\Player;
use function basename;

class OtherBlocks7 extends SimpleForm {

	private string $shopNumber;
	private array $contents;

	public function __construct(Player $player) {
		$this->shopNumber = basename(__DIR__);
		$this->contents = [
			VanillaBlocks::ITEM_FRAME()->asItem(),
			VanillaBlocks::FLETCHING_TABLE()->asItem(),
			VanillaBlocks::COMPOUND_CREATOR()->asItem(),
			VanillaBlocks::LOOM()->asItem(),
			VanillaBlocks::ELEMENT_CONSTRUCTOR()->asItem(),
			VanillaBlocks::LAB_TABLE()->asItem(),
			VanillaBlocks::MATERIAL_REDUCER()->asItem(),
			VanillaBlocks::BREWING_STAND()->asItem(),
			VanillaBlocks::ENCHANTING_TABLE()->asItem(),
			VanillaBlocks::BARREL()->asItem(),
			VanillaBlocks::NOTE_BLOCK()->asItem(),
			VanillaBlocks::JUKEBOX()->asItem(),
			VanillaBlocks::EMERALD()->asItem(),
		];
		Calculation::getInstance()->sendButton($player, $this->shopNumber, $this->contents, $this);
	}

	public function handleClosed(Player $player) : void {
		SoundPacket::Send($player, 'mob.shulker.close');
		SendForm::Send($player, Calculation::getInstance()->secondBackFormClass($this->shopNumber));
	}
}
