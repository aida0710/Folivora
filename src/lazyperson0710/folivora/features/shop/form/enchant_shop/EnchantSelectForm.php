<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\form\enchant_shop;

use bbo51dog\bboform\form\SimpleForm;
use lazyperson0710\folivora\features\shop\database\EnchantShopAPI;
use lazyperson0710\folivora\features\shop\form\enchant_shop\element\EnchantSelectFormButton;
use pocketmine\data\bedrock\EnchantmentIdMap;
use pocketmine\data\bedrock\EnchantmentIds;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\lang\Translatable;
use pocketmine\Server;

class EnchantSelectForm extends SimpleForm {

	public function __construct(?string $error = '') {
		$enchants = [
			VanillaEnchantments::SHARPNESS(),
			VanillaEnchantments::EFFICIENCY(),
			VanillaEnchantments::SILK_TOUCH(),
			EnchantmentIdMap::getInstance()->fromId(EnchantmentIds::FORTUNE),
			VanillaEnchantments::UNBREAKING(),
			VanillaEnchantments::POWER(),
		];
		$api = EnchantShopAPI::getInstance();
		$this
			->setTitle('Enchant Form')
			->setText("付与したい効果を選択してください\n{$error}");
		foreach ($enchants as $enchantment) {
			$enchantName = $enchantment->getName();
			if ($enchantName instanceof Translatable) {
				$enchantName = Server::getInstance()->getLanguage()->translate($enchantName);
			}
			$this->addElement(new EnchantSelectFormButton("{$enchantName} 価格 - 毎lv.{$api->getBuy($enchantName)}\nMiningLevel制限{$api->getMiningLevel($enchantName)} | 付与レベル制限 - {$api->getLevelLimit($enchantName)}以下", $enchantment, $enchantName));
		}
	}

}
