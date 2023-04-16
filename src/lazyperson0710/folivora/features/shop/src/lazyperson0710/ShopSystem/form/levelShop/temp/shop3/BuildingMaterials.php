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

class BuildingMaterials extends SimpleForm {

	private string $shopNumber;
	private array $contents;

	public function __construct(Player $player) {
		$this->shopNumber = basename(__DIR__);
		$this->contents = [
			VanillaBlocks::STONE_BRICKS()->asItem(),
			VanillaBlocks::BRICKS()->asItem(),
			VanillaBlocks::QUARTZ()->asItem(),
			VanillaBlocks::GLASS()->asItem(),
			VanillaBlocks::WOOL()->asItem(),
			VanillaBlocks::PRISMARINE()->asItem(),
			VanillaBlocks::PRISMARINE_BRICKS()->asItem(),
			VanillaBlocks::DARK_PRISMARINE()->asItem(),
			VanillaBlocks::HARDENED_CLAY()->asItem(),
			VanillaBlocks::PURPUR()->asItem(),
			VanillaBlocks::CLAY()->asItem(),
			VanillaBlocks::NETHERRACK()->asItem(),
			VanillaBlocks::END_STONE()->asItem(),
			VanillaBlocks::GLOWSTONE()->asItem(),
			VanillaBlocks::SEA_LANTERN()->asItem(),
			VanillaBlocks::RED_SAND()->asItem(),
			VanillaBlocks::RED_SANDSTONE()->asItem(),
		];
		Calculation::getInstance()->sendButton($player, $this->shopNumber, $this->contents, $this);
	}

	public function handleClosed(Player $player) : void {
		SoundPacket::Send($player, 'mob.shulker.close');
		SendForm::Send($player, Calculation::getInstance()->secondBackFormClass($this->shopNumber));
	}
}
