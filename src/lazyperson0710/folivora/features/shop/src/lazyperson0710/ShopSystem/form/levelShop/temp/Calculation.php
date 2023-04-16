<?php

declare(strict_types = 1);

namespace lazyperson0710\ShopSystem\form\levelShop\temp;

use deceitya\MiningLevel\MiningLevelAPI;
use lazyperson0710\ShopSystem\database\LevelShopAPI;
use lazyperson0710\ShopSystem\form\element\SecondBackFormButton;
use lazyperson0710\ShopSystem\form\element\SellBuyItemFormButton;
use lazyperson0710\ShopSystem\form\element\ShopMainCategoryFormButton;
use lazyperson0710\ShopSystem\form\levelShop\other\SearchShop\InputItemForm;
use lazyperson0710\ShopSystem\object\ShopItem;
use pocketmine\form\Form;
use pocketmine\item\Item;
use pocketmine\player\Player;
use pocketmine\utils\SingletonTrait;
use function str_replace;

class Calculation {

	use SingletonTrait;

	public function sendButton(Player $player, string $shopNumber, ShopItem $items, $class) : void {
		if (empty($items)) {
			$text = '§c検索した値ではアイテムは検出されませんでした';
		} else {
			$text = '§7選択してください';
		}
		$class->setTitle('Level Shop');
		$class->setText($text);
		$api = LevelShopAPI::getInstance();
		foreach ($items as $item) {
			$id = $item;
			$meta = 0;
			if ($item instanceof Item) {
				$id = $item->getId();
				$meta = $item->getMeta();
			}
			if (MiningLevelAPI::getInstance()->getLevel($player) < $api->getShop($id, $meta)) {
				$error = "§c{$api->getItemName($id ,$meta)} - レベル不足/lv.{$api->getShop($id, $meta)}§r";
			} else {
				$error = "{$api->getItemName($id ,$meta)}";
			}
			$class->addElements(new SellBuyItemFormButton("{$error}\n購入:{$api->getBuy($id ,$meta)} / 売却:{$api->getSell($id ,$meta)}", $id, $meta));
		}
		if ($shopNumber === 'search') {
			$class->addElements(new ShopMainCategoryFormButton('検索画面に戻る', new InputItemForm()));
			return;
		}
		$shopClass = self::getInstance()->secondBackFormClass($shopNumber);
		$class->addElements(new SecondBackFormButton('一つ戻る', $shopClass));
	}

	public function secondBackFormClass(string $shopNumber) : Form {
		$shopNumber = str_replace('shop', '', $shopNumber);
		$shopNumber = (int) $shopNumber;
		$class = '\lazyperson0710\ShopAPI\form\levelShop\shop' . $shopNumber . '\Shop' . $shopNumber . 'Form';
		return new $class();
	}
}
