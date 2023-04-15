<?php

declare(strict_types = 0);

namespace lazyperson0710\ShopSystem\form\levelShop\temp\shop3;

use bbo51dog\bboform\form\SimpleForm;
use lazyperson0710\ShopSystem\form\levelShop\temp\Calculation;
use lazyperson710\core\packet\SendForm;
use lazyperson710\core\packet\SoundPacket;
use pocketmine\block\VanillaBlocks;
use pocketmine\player\Player;
use function basename;

class Ores extends SimpleForm {

	private string $shopNumber;
	private array $contents;

	public function __construct(Player $player) {
		$this->shopNumber = basename(__DIR__);
		$this->contents = [
			VanillaBlocks::COAL_ORE()->asItem(),
			VanillaBlocks::LAPIS_LAZULI_ORE()->asItem(),
			VanillaBlocks::REDSTONE_ORE()->asItem(),
			VanillaBlocks::DIAMOND_ORE()->asItem(),
			VanillaBlocks::NETHER_QUARTZ_ORE()->asItem(),
			VanillaBlocks::EMERALD_ORE()->asItem(),
		];
		Calculation::getInstance()->sendButton($player, $this->shopNumber, $this->contents, $this);
	}

	public function handleClosed(Player $player) : void {
		SoundPacket::Send($player, 'mob.shulker.close');
		SendForm::Send($player, Calculation::getInstance()->secondBackFormClass($this->shopNumber));
	}
}
