<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\form\item_shop\other;

use bbo51dog\bboform\element\Button;
use bbo51dog\bboform\form\SimpleForm;
use Deceitya\MiningLevel\MiningLevelAPI;
use lazyperson0710\folivora\features\shop\database\ItemShopAPI;
use lazyperson0710\folivora\features\shop\form\item_shop\future\FormText;
use lazyperson0710\folivora\features\shop\form\item_shop\future\ItemSell;
use lazyperson0710\folivora\features\shop\form\item_shop\future\LevelCheck;
use lazyperson0710\folivora\features\shop\form\item_shop\future\RestrictionShop;
use lazyperson0710\folivora\features\shop\object\ItemShopObject;
use pocketmine\item\Item;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use RuntimeException;

class InvSellForm extends SimpleForm {

    /** @var Item[] */
    private array $sellItems;

    public function __construct(Player $player) {
        $items = $this->getSellItems($player);
        $explanation =
            'インベントリ内のアイテムを一括売却します' . PHP_EOL .
            '売却額が0円のアイテム(ツールなど)は売却されません' . PHP_EOL . PHP_EOL .
            '以下売却可能なアイテム一覧' . PHP_EOL .
            $text = null;
        if ($items === []) $text = PHP_EOL . TextFormat::RED . '売却できるアイテムが存在しません';
        $this->sellItems = $items;
        $total = 0;
        foreach ($this->sellItems as $item) {
            $shopItem = ItemShopAPI::getInstance()->getItemByItemID($item);
            if (!$item instanceof Item) throw new RuntimeException('Itemではありません');
            if (!$shopItem instanceof ItemShopObject) throw new RuntimeException('ItemShopObjectではありません');
            $text .= PHP_EOL . $shopItem->getDisplayName() . ' / 数量: ' . number_format($item->getCount()) . ' / 売却: ' . number_format($shopItem->getSell()) . '円 / 合計' . number_format($shopItem->getSell() * $item->getCount()) . '円';
            $total += ($shopItem->getSell() * $item->getCount());
        }
        $this
            ->setTitle(FormText::TITLE)
            ->setText($explanation . $text . PHP_EOL . PHP_EOL . '合計売却額: ' . number_format($total) . '円')
            ->addElements(new Button('確認画面に進む'));
    }

    /**
     * @param Player $player
     * @return Item[]
     */
    private function getSellItems(Player $player): array {
        $sellItems = [];
        for ($i = 0, $size = $player->getInventory()->getSize(); $i < $size; ++$i) {
            $item = clone $player->getInventory()->getItem($i);
            $shopItem = ItemShopAPI::getInstance()->getItemByItemID($item);
            if (!$shopItem instanceof ItemShopObject) continue;
            if ($shopItem->getSell() == 0) continue;
            if (MiningLevelAPI::getInstance()->getLevel($player) < RestrictionShop::getInstance()->getRestrictionByShopNumber($shopItem->getShopId())) {
                continue;
            }
            $sellItems[$i] = $item;
        }
        return $sellItems;
    }

    public function handleSubmit(Player $player): void {
        if ($this->sellItems === []) {
            LevelCheck::sendForm($player, new OtherShopSelectForm($player), RestrictionShop::RESTRICTION_LEVEL_OTHER_SHOP);
            return;
        }
        foreach ($this->sellItems as $item) {
            if (!$item instanceof Item) throw new RuntimeException('Itemではありません');
            $shopItem = ItemShopAPI::getInstance()->getItemByItemID($item);
            if (!$shopItem instanceof ItemShopObject) throw new RuntimeException('ItemShopObjectではありません');
            ItemSell::getInstance()->transaction($player, $item->getCount(), $shopItem, 0, false);
        }
    }
}
