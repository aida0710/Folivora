<?php

declare(strict_types = 1);

namespace lazyperson0710\ShopSystem\form\levelShop\temp\shop6;

use bbo51dog\bboform\form\SimpleForm;
use lazyperson0710\ShopSystem\form\levelShop\temp\Calculation;
use lazyperson710\core\packet\SendForm;
use lazyperson710\core\packet\SoundPacket;
use pocketmine\block\VanillaBlocks;
use pocketmine\player\Player;
use function basename;

class Vegetation extends SimpleForm {

	private string $shopNumber;
	private array $contents;

	public function __construct(Player $player) {
		$this->shopNumber = basename(__DIR__);
		$this->contents = [
			VanillaBlocks::DANDELION()->asItem(),
			VanillaBlocks::POPPY()->asItem(),
			VanillaBlocks::BLUE_ORCHID()->asItem(),
			VanillaBlocks::ALLIUM()->asItem(),
			VanillaBlocks::AZURE_BLUET()->asItem(),
			VanillaBlocks::RED_TULIP()->asItem(),
			VanillaBlocks::ORANGE_TULIP()->asItem(),
			VanillaBlocks::WHITE_TULIP()->asItem(),
			VanillaBlocks::PINK_TULIP()->asItem(),
			VanillaBlocks::OXEYE_DAISY()->asItem(),
			VanillaBlocks::CORNFLOWER()->asItem(),
			VanillaBlocks::LILY_OF_THE_VALLEY()->asItem(),
			VanillaBlocks::LILAC()->asItem(),
			VanillaBlocks::ROSE_BUSH()->asItem(),
			VanillaBlocks::PEONY()->asItem(),
			VanillaBlocks::FERN()->asItem(),
			VanillaBlocks::LARGE_FERN()->asItem(),
			VanillaBlocks::TALL_GRASS()->asItem(),
			VanillaBlocks::DOUBLE_TALLGRASS()->asItem(),
			VanillaBlocks::DEAD_BUSH()->asItem(),
			VanillaBlocks::DEAD_BUSH()->asItem(),
			VanillaBlocks::DEAD_BUSH()->asItem(),
			VanillaBlocks::LILY_PAD()->asItem(),
			VanillaBlocks::VINES()->asItem(),
		];
		Calculation::getInstance()->sendButton($player, $this->shopNumber, $this->contents, $this);
	}

	public function handleClosed(Player $player) : void {
		SoundPacket::Send($player, 'mob.shulker.close');
		SendForm::Send($player, Calculation::getInstance()->secondBackFormClass($this->shopNumber));
	}
}
