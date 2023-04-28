<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\form\enchant_shop\element;

use bbo51dog\bboform\element\Button;
use bbo51dog\bboform\element\ButtonImage;
use deceitya\MiningLevel\MiningLevelAPI;
use lazyperson0710\folivora\features\shop\database\EnchantShopAPI;
use lazyperson0710\folivora\features\shop\form\enchant_shop\EnchantConfirmationForm;
use lazyperson0710\folivora\features\shop\form\enchant_shop\EnchantSelectForm;
use lazyperson710\core\packet\SendForm;
use lazyperson710\core\packet\SoundPacket;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\player\Player;

class EnchantSelectFormButton extends Button {

	private Enchantment $enchantment;
	private string $enchantName;

	public function __construct(string $text, Enchantment $enchantment, string $enchantName, ?ButtonImage $image = null) {
		parent::__construct($text, $image);
		$this->enchantment = $enchantment;
		$this->enchantName = $enchantName;
	}

	public function handleSubmit(Player $player) : void {
		if (MiningLevelAPI::getInstance()->getLevel($player) >= EnchantShopAPI::getInstance()->getMiningLevel($this->enchantName)) {
			SendForm::Send($player, (new EnchantConfirmationForm($player, $this->enchantment)));
		} else {
			SendForm::Send($player, (new EnchantSelectForm("§cMiningLevelが足りないためformを開けませんでした\n要求レベル ->" . EnchantShopAPI::getInstance()->getMiningLevel($this->enchantName) . 'lv')));
			SoundPacket::Send($player, 'dig.chain');
		}
	}
}
