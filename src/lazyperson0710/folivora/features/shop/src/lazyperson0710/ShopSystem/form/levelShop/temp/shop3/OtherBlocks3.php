<?php

declare(strict_types = 1);

namespace lazyperson0710\ShopSystem\form\levelShop\temp\shop3;

use bbo51dog\bboform\form\SimpleForm;
use lazyperson0710\ShopSystem\form\levelShop\temp\Calculation;
use lazyperson710\core\packet\SendForm;
use lazyperson710\core\packet\SoundPacket;
use pocketmine\block\VanillaBlocks;
use pocketmine\player\Player;
use function basename;

class OtherBlocks3 extends SimpleForm {

	private string $shopNumber;
	private array $contents;

	public function __construct(Player $player) {
		$this->shopNumber = basename(__DIR__);
		$this->contents = [
			VanillaBlocks::PACKED_ICE()->asItem(),
			VanillaBlocks::OBSIDIAN()->asItem(),
			VanillaBlocks::END_ROD()->asItem(),
			VanillaBlocks::ANVIL()->asItem(),
			VanillaBlocks::SHULKER_BOX()->asItem(),
			VanillaBlocks::SLIME()->asItem(),
			VanillaBlocks::BOOKSHELF()->asItem(),
			VanillaBlocks::COBWEB()->asItem(),
			VanillaBlocks::BLAST_FURNACE()->asItem(),
			VanillaBlocks::SMOKER()->asItem(),
			VanillaBlocks::LECTERN()->asItem(),
			VanillaBlocks::RAIL()->asItem(),
			VanillaBlocks::POWERED_RAIL()->asItem(),
			VanillaBlocks::ACTIVATOR_RAIL()->asItem(),
			VanillaBlocks::DETECTOR_RAIL()->asItem(),
		];
		Calculation::getInstance()->sendButton($player, $this->shopNumber, $this->contents, $this);
	}

	public function handleClosed(Player $player) : void {
		SoundPacket::Send($player, 'mob.shulker.close');
		SendForm::Send($player, Calculation::getInstance()->secondBackFormClass($this->shopNumber));
	}
}
