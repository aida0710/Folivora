<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\form\item_shop\other\search;

use bbo51dog\bboform\form\SimpleForm;
use Deceitya\MiningLevel\MiningLevelAPI;
use lazyperson0710\folivora\features\shop\form\item_shop\element\SendMenuFormButton;
use lazyperson0710\folivora\features\shop\form\item_shop\future\FormText;
use lazyperson0710\folivora\features\shop\form\item_shop\future\RestrictionShop;
use lazyperson0710\folivora\features\shop\form\item_shop\ItemBuyForm;
use lazyperson0710\folivora\features\shop\object\ItemShopObject;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use RuntimeException;

class SearchResultForm extends SimpleForm {

    public function __construct(Player $player, array $items) {
        $this
            ->setTitle(FormText::TITLE)
            ->setText('コンテンツを選択してください');
        foreach ($items as $item) {
            if (!$item instanceof ItemShopObject) throw new RuntimeException('ShopItemの配列を渡してください');
            $restriction = RestrictionShop::getInstance()->getRestrictionByShopNumber($item->getShopId());
            if (MiningLevelAPI::getInstance()->getLevel($player) < RestrictionShop::getInstance()->getRestrictionByShopNumber($item->getShopId())) {
                $content = TextFormat::RED . $item->getDisplayName() . ' - レベル不足/lv.' . $restriction . TextFormat::RESET;
            } else {
                $content = $item->getDisplayName();
            }
            $this->addElement(new SendMenuFormButton($content . PHP_EOL . '購入: ' . number_format($item->getBuy()) . '円 / 売却: 不可', new ItemBuyForm($player, $item), $restriction),);
        }
        $this->addElement(new SendMenuFormButton('検索画面に戻る', new SearchItemForm(), RestrictionShop::RESTRICTION_LEVEL_OTHER_SHOP));
    }
}
