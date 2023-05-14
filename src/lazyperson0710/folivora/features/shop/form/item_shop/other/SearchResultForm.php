<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\form\item_shop\other;

use bbo51dog\bboform\form\SimpleForm;
use Deceitya\MiningLevel\MiningLevelAPI;
use lazyperson0710\folivora\features\shop\form\item_shop\element\SendMenuFormButton;
use lazyperson0710\folivora\features\shop\form\item_shop\future\RestrictionShop;
use lazyperson0710\folivora\features\shop\form\item_shop\future\ShopText;
use lazyperson0710\folivora\features\shop\object\ItemShopObject;
use lazyperson0710\ShopSystem\form\element\SellBuyItemFormButton;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use RuntimeException;
use const PHP_EOL;

class SearchResultForm extends SimpleForm implements ShopText {

    public function __construct(Player $player, array $items) {
        $this
            ->setTitle(self::TITLE)
            ->setText(self::SEARCH_CONTENT);
        foreach ($items as $item) {
            if (!$item instanceof ItemShopObject) throw new RuntimeException('ShopItemの配列を渡してください');
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
