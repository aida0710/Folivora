<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\form\item_shop\other;

use bbo51dog\bboform\element\Input;
use bbo51dog\bboform\form\CustomForm;
use lazyperson0710\folivora\features\shop\database\ItemShopAPI;
use lazyperson0710\folivora\features\shop\form\item_shop\future\ShopText;
use lazyperson0710\folivora\features\shop\object\ItemShopObject;
use lazyperson710\core\packet\SendForm;
use lazyperson710\core\packet\SoundPacket;
use pocketmine\player\Player;
use function preg_match;
use function str_contains;

class SearchItemForm extends CustomForm implements ShopText {

	private Input $itemName;

	public function __construct(?string $msg = null) {
		$this->itemName = new Input("{$msg}調べたいアイテムの名前を入力してください\n入力した値が含まれている名前のアイテムがすべて表示されます", '石');
		$this
			->setTitle(self::TITLE)
			->addElements(
				$this->itemName,
			);
	}

	public function handleSubmit(Player $player) : void {
		$items = [];
		if (!preg_match('/[ぁ-ん]+|[ァ-ヴー]+|[一-龠]/u', $this->itemName->getValue())) {
			SendForm::Send($player, (new SearchItemForm("§c例外が発生しました\nitemNameの入力欄には日本語(ひらがな/カタカナ/漢字)を含める必要があります\n")));
			SoundPacket::Send($player, 'dig.chain');
			return;
		}
		foreach (ItemShopAPI::getInstance()->getDisplayName() as $displayName) {
			if (str_contains($displayName, $this->itemName->getValue())) {
				$items[] = ItemShopAPI::getInstance()->getItemByDisplayName($displayName);
			}
		}
		if (empty($items)) {
			SendForm::Send($player, (new SearchItemForm("§c例外が発生しました\n入力した値が含まれている名前のアイテムが見つかりませんでした\n")));
			SoundPacket::Send($player, 'dig.chain');
			return;
		}
		/** @var array<ItemShopObject> $items */
		SendForm::Send($player, new SearchResultForm($player, $items));
	}
}
