<?php

declare(strict_types = 0);

namespace lazyperson0710\ShopSystem\form\levelShop\temp\shop7;

use bbo51dog\bboform\form\SimpleForm;
use lazyperson0710\ShopSystem\form\levelShop\temp\Calculation;
use lazyperson710\core\packet\SendForm;
use lazyperson710\core\packet\SoundPacket;
use pocketmine\block\VanillaBlocks;
use pocketmine\player\Player;
use function basename;

class RedStone extends SimpleForm {

	private string $shopNumber;
	private array $contents;

	public function __construct(Player $player) {
		$this->shopNumber = basename(__DIR__);
		$this->contents = [
			VanillaBlocks::DAYLIGHT_SENSOR()->asItem(),
			VanillaBlocks::HOPPER()->asItem(),
			VanillaBlocks::TNT()->asItem(),
			-239,
			VanillaBlocks::TRIPWIRE_HOOK()->asItem(),
			VanillaBlocks::TRAPPED_CHEST()->asItem(),
			VanillaBlocks::REDSTONE_TORCH()->asItem(),
		];
		Calculation::getInstance()->sendButton($player, $this->shopNumber, $this->contents, $this);
	}

	public function handleClosed(Player $player) : void {
		SoundPacket::Send($player, 'mob.shulker.close');
		SendForm::Send($player, Calculation::getInstance()->secondBackFormClass($this->shopNumber));
	}
}
