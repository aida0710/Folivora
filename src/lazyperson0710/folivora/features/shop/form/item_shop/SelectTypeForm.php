<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\form\item_shop;

use bbo51dog\bboform\form\SimpleForm;
use lazyperson0710\folivora\features\electronic_money\currency\Money;
use lazyperson0710\folivora\features\shop\form\item_shop\element\ItemSelectBackFormButton;
use lazyperson0710\folivora\features\shop\form\item_shop\element\SendMenuFormButton;
use lazyperson0710\folivora\features\shop\form\item_shop\future\FormText;
use lazyperson0710\folivora\features\shop\form\item_shop\future\ItemHoldingCalculation;
use lazyperson0710\folivora\features\shop\form\item_shop\future\LevelCheck;
use lazyperson0710\folivora\features\shop\form\item_shop\future\RestrictionShop;
use lazyperson0710\folivora\features\shop\object\ItemShopObject;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use ree_jp\stackstorage\api\StackStorageAPI;

class SelectTypeForm extends SimpleForm {

    private ItemShopObject $item;

    public function __construct(Player $player, ItemShopObject $item) {
        $this->item = $item;
        $restriction = RestrictionShop::getInstance()->getRestrictionByShopNumber($item->getShopId());
        $this
            ->setTitle(FormText::TITLE)
            ->addElements(
                new SendMenuFormButton('購入画面に進む', new ItemBuyForm($player, $item), $restriction),
                new SendMenuFormButton('売却画面に進む', new ItemSellForm($player, $item), $restriction),
                new ItemSelectBackFormButton('カテゴリアイテム選択メニューに戻る', $item),
            );
        StackStorageAPI::$instance->getCount($player->getXuid(), $item->getItem(),
            function ($virtualStorageItemCount) use ($player, $item) : void {
                $this->setText(self::getLabel($player, $item, $virtualStorageItemCount));
            }, function () use ($player, $item) : void {
                $this->setText(self::getLabel($player, $item, 0));
            },
        );
    }

    public static function getLabel(Player $player, ItemShopObject $item, int $virtualStorageItemCount) : string {
        $inventoryItemCount = ItemHoldingCalculation::getHoldingCount($player, $item->getItem());
        $notWorkingItem = null;
        if (!$item->isWorkingItem()) $notWorkingItem = PHP_EOL . TextFormat::RED . '注意 : このアイテムはバニラの挙動を示さず設置のみ可能です。';
        return
            'アイテム販売階層: Shop' . $item->getShopId() . ' / ' . $item->getItemCategory() . ' / ' . $item->getDisplayName() . PHP_EOL . PHP_EOL .
            'アイテム名: ' . $item->getDisplayName() . ' / ' . $item->getItem()->getVanillaName() . PHP_EOL .
            '購入価格: ' . number_format($item->getBuy()) . '円 / (1st -> ' . number_format(($item->getBuy() * 64)) . '円' . PHP_EOL .
            '売却価格: ' . number_format($item->getSell()) . '円 / (1st -> ' . number_format(($item->getSell() * 64)) . '円' . PHP_EOL . PHP_EOL .
            '現在の所持金: ' . number_format(Money::getInstance()->getFunction($player)->getCurrency()) . '円' . PHP_EOL .
            'インベントリに所有している数: ' . number_format($inventoryItemCount) . '個' . PHP_EOL .
            '仮想ストレージに所有している数: ' . number_format($virtualStorageItemCount) . '個' . PHP_EOL .
            '合計所持数(インベントリ + 仮想ストレージ): ' . number_format($inventoryItemCount + $virtualStorageItemCount) . '個' .
            $notWorkingItem;
    }

    public function handleClosed(Player $player) : void {
        LevelCheck::sendForm($player, new ItemSelectForm($player, $this->item->getShopId(), $this->item->getItemCategory()), RestrictionShop::getInstance()->getRestrictionByShopNumber($this->item->getShopId()));
    }

}
