<?php

declare(strict_types = 1);

namespace lazyperson0710\ShopSystem\form\levelShop\temp\shop1;

use bbo51dog\bboform\form\SimpleForm;
use lazyperson0710\ShopSystem\form\levelShop\temp\Calculation;
use lazyperson710\core\packet\SendForm;
use lazyperson710\core\packet\SoundPacket;
use pocketmine\block\VanillaBlocks;
use pocketmine\player\Player;
use function basename;

class Logs extends SimpleForm {

	private string $shopNumber;
	private array $contents;

	public function __construct(Player $player) {
		$this->shopNumber = basename(__DIR__);
		$this->contents = [
			VanillaBlocks::OAK_LOG()->asItem(),
			VanillaBlocks::SPRUCE_LOG()->asItem(),
			VanillaBlocks::BIRCH_LOG()->asItem(),
			VanillaBlocks::JUNGLE_LOG()->asItem(),
			VanillaBlocks::ACACIA_LOG()->asItem(),
			VanillaBlocks::DARK_OAK_LOG()->asItem(),
		];
		Calculation::getInstance()->sendButton($player, $this->shopNumber, $this->contents, $this);
	}

	public function handleClosed(Player $player) : void {
		SoundPacket::Send($player, 'mob.shulker.close');
		SendForm::Send($player, Calculation::getInstance()->secondBackFormClass($this->shopNumber));
	}
}
