<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\form\item_shop\temp\shop6;

use bbo51dog\bboform\form\SimpleForm;
use lazyperson0710\ShopSystem\form\element\ShopItemFormButton;
use lazyperson0710\ShopSystem\form\levelShop\element\FirstBackFormButton;
use lazyperson0710\ShopSystem\form\levelShop\temp\MainLevelShopForm;
use lazyperson710\core\packet\SendForm;
use lazyperson710\core\packet\SoundPacket;
use pocketmine\player\Player;

class Shop6Form extends SimpleForm {

	public function __construct() {
		$contents = [
			'装飾ブロック類' => 'DecorativeBlock',
			'モブヘッド' => 'Heads',
			'植物類' => 'Vegetation',
		];
		$this
			->setTitle('Level Shop')
			->setText('§7選択してください');
		foreach ($contents as $key => $value) {
			$class = __NAMESPACE__ . "\\" . $value;
			$this->addElements(new ShopItemFormButton($key, $class));
		}
		$this->addElements(new FirstBackFormButton('ホームに戻る'));
	}

	public function handleClosed(Player $player) : void {
		SoundPacket::Send($player, 'mob.shulker.close');
		SendForm::Send($player, (new MainLevelShopForm($player)));
	}

}
