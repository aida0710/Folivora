<?php

declare(strict_types = 0);

namespace lazyperson0710\ShopSystem\form\levelShop\other;

use bbo51dog\bboform\form\SimpleForm;
use Deceitya\MiningLevel\MiningLevelAPI;
use lazyperson0710\ShopSystem\form\element\SellBuyItemFormButton;
use lazyperson0710\ShopSystem\form\levelShop\element\SendMenuFormButton;
use lazyperson0710\ShopSystem\form\levelShop\future\RestrictionShop;
use lazyperson0710\ShopSystem\form\levelShop\future\ShopText;
use lazyperson0710\ShopSystem\object\ShopItem;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use RuntimeException;

class SearchResultForm extends SimpleForm implements ShopText {

	public function __construct(Player $player, array $items) {
		$this
			->setTitle(self::TITLE)
			->setText(self::SEARCH_CONTENT);
		foreach ($items as $item) {
			if (!$item instanceof ShopItem) throw new RuntimeException('ShopItemの配列を渡してください');
			$restriction = RestrictionShop::getInstance()->getRestrictionByShopNumber($item->getShopId());
			if (MiningLevelAPI::getInstance()->getLevel($player) < RestrictionShop::getInstance()->getRestrictionByShopNumber($item->getShopId())) {
				$content = TextFormat::RED . $item->getDisplayName() . ' - レベル不足/lv.' . $restriction . TextFormat::RESET;
			} else {
				$content = $item->getDisplayName();
			}
			//todo 購入
			$this->addElement(new SellBuyItemFormButton($content . PHP_EOL . '購入:' . $item->getBuy() . '円 / 売却:' . $item->getSell() . '円', $id, $meta));
		}
		$this->addElement(new SendMenuFormButton('検索画面に戻る', new SearchItemForm(), RestrictionShop::RESTRICTION_LEVEL_OTHER_SHOP));
	}
}
