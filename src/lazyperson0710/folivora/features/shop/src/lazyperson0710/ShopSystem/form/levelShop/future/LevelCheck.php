<?php

declare(strict_types = 1);

namespace lazyperson0710\ShopSystem\form\levelShop\future;

use bbo51dog\bboform\form\FormBase;
use Deceitya\MiningLevel\MiningLevelAPI;
use lazyperson0710\ShopSystem\form\levelShop\ShopSelectForm;
use lazyperson710\core\packet\SendForm;
use lazyperson710\core\packet\SoundPacket;
use pocketmine\player\Player;
use pocketmine\utils\SingletonTrait;
use pocketmine\utils\TextFormat;
use const PHP_EOL;

class LevelCheck {

	use SingletonTrait;

	public function check(Player $player, FormBase $formBase, int $restrictionLevel) : void {
		if (MiningLevelAPI::getInstance()->getLevel($player) >= $restrictionLevel) {
			SendForm::Send($player, $formBase);
		} else {
			$error = PHP_EOL . TextFormat::RED . '要求されたレベルに達していない為処理が中断されました' . PHP_EOL . '要求レベル -> lv.' . $restrictionLevel;
			SendForm::Send($player, (new ShopSelectForm($player, $error)));
			SoundPacket::Send($player, 'dig.chain');
		}
	}

}
