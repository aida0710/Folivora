<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\form\item_shop\temp\shop6;

use bbo51dog\bboform\form\SimpleForm;
use lazyperson0710\ShopSystem\form\levelShop\temp\Calculation;
use lazyperson710\core\packet\SendForm;
use lazyperson710\core\packet\SoundPacket;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use function basename;

class Heads extends SimpleForm {

	private string $shopNumber;
	private array $contents;

	public function __construct(Player $player) {
		$this->shopNumber = basename(__DIR__);
		$this->contents = [
			VanillaItems::PLAYER_HEAD(),
			VanillaItems::ZOMBIE_HEAD(),
			VanillaItems::SKELETON_SKULL(),
			VanillaItems::CREEPER_HEAD(),
			VanillaItems::WITHER_SKELETON_SKULL(),
			VanillaItems::DRAGON_HEAD(),
		];
		Calculation::getInstance()->sendButton($player, $this->shopNumber, $this->contents, $this);
	}

	public function handleClosed(Player $player) : void {
		SoundPacket::Send($player, 'mob.shulker.close');
		SendForm::Send($player, Calculation::getInstance()->secondBackFormClass($this->shopNumber));
	}
}
