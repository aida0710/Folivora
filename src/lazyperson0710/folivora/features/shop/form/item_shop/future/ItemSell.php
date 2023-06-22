<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\form\item_shop\future;

use Deceitya\MiningLevel\MiningLevelAPI;
use lazyperson0710\folivora\features\electronic_money\currency\Money;
use lazyperson0710\folivora\features\shop\database\ItemShopAPI;
use lazyperson0710\folivora\features\shop\object\ItemShopObject;
use lazyperson0710\folivora\util\message\send_message\SendMessage;
use pocketmine\player\Player;
use pocketmine\utils\SingletonTrait;
use ree_jp\stackstorage\api\StackStorageAPI;

class ItemSell {

    use SingletonTrait;

    public function transaction(Player $player, int $sellCount, ItemShopObject $item, int $virtualStorageItemCount, bool $virtualStorageEnable): void {
        if (MiningLevelAPI::getInstance()->getLevel($player) < RestrictionShop::getInstance()->getRestrictionByShopNumber($item->getShopId())) {
            SendMessage::Send($player, $item->getDisplayName() . 'を売却するには' . RestrictionShop::getInstance()->getRestrictionByShopNumber($item->getShopId()) . '以上のマイニングレベルが必要です', ItemShopAPI::PREFIX, false);
            return;
        }
        $item->getItem()->setCount($sellCount);
        $inventoryItemCount = ItemHoldingCalculation::getHoldingCount($player, $item->getItem());
        if ($virtualStorageEnable && $virtualStorageItemCount === 0) {
            if ($sellCount <= $virtualStorageItemCount) {
                $resultSalePrice = number_format($this->buyItemFromStackStorage($player, $item, $sellCount));
                SendMessage::Send($player, $item->getDisplayName() . 'を仮想ストレージから' . $sellCount . "個売却し所持金が{$resultSalePrice}円増えました", ItemShopAPI::PREFIX, true, 'break.amethyst_block');
                return;
            }
            $storageItemCount = $sellCount - $virtualStorageItemCount;
            if ($storageItemCount <= $inventoryItemCount) {
                $storageResultSalePrice = $this->buyItemFromStackStorage($player, $item, $virtualStorageItemCount);
                $inventoryResultSalePrice = $this->buyItemFromInventory($player, $item, $storageItemCount);
                $resultSalePrice = number_format($storageResultSalePrice + $inventoryResultSalePrice);
                SendMessage::Send($player, $item->getDisplayName() . 'を仮想ストレージから' . number_format($virtualStorageItemCount) . '個とインベントリから' . number_format($storageItemCount) . '個の計' . number_format($virtualStorageItemCount + $storageItemCount) . "アイテムが売却され、所持金が{$resultSalePrice}円増えました", ItemShopAPI::PREFIX, true, 'break.amethyst_block');
                return;
            }
            SendMessage::Send($player, $item->getDisplayName() . 'がない、もしくは足りません', ItemShopAPI::PREFIX, false, 'dig.chain');
            return;
        }
        if (!$player->getInventory()->contains($item->getItem())) {
            $storageItemCount = $sellCount - $inventoryItemCount;
            if ($storageItemCount <= $virtualStorageItemCount) {
                $storageResult = $this->buyItemFromStackStorage($player, $item, $storageItemCount); //$this->price * $storageItemCount;
                if ($inventoryItemCount === 0) {
                    SendMessage::Send($player, $item->getDisplayName() . 'を仮想ストレージから' . number_format($storageItemCount) . '個アイテムが売却され、所持金が ' . number_format($storageResult) . '円増えました', ItemShopAPI::PREFIX, true, 'break.amethyst_block');
                    return;
                }
                $inventoryResult = $this->buyItemFromInventory($player, $item, $inventoryItemCount);
                $result = $inventoryResult + $storageResult;
                SendMessage::Send($player, $item->getDisplayName() . 'を仮想ストレージから' . number_format($storageItemCount) . '個とインベントリから' . number_format($inventoryItemCount) . '個の計' . number_format($storageItemCount + $inventoryItemCount) . 'アイテムが売却され、所持金が' . number_format($result) . '円増えました', ItemShopAPI::PREFIX, true, 'break.amethyst_block');
                return;
            }
            SendMessage::Send($player, $item->getDisplayName() . 'がない、もしくは足りません', ItemShopAPI::PREFIX, false, 'dig.chain');
            return;
        }
        $this->buyItemFromInventory($player, $item, $sellCount);
        $result = $item->getSell() * $sellCount;
        SendMessage::Send($player, $item->getDisplayName() . 'が' . number_format($sellCount) . '個売却され、所持金が' . number_format($result) . '円増えました', ItemShopAPI::PREFIX, true, 'break.amethyst_block');
    }

    private function buyItemFromStackStorage(Player $player, ItemShopObject $item, int $count): int {
        $itemClone = (clone $item->getItem())->setCount($count);
        $storageResult = $item->getSell() * $count;
        StackStorageAPI::$instance->remove($player->getXuid(), $itemClone);
        Money::getInstance()->getFunction($player)->addCurrency($storageResult);
        return $storageResult;
    }

    private function buyItemFromInventory(Player $player, ItemShopObject $item, int $count): int {
        $itemClone = (clone $item->getItem())->setCount($count);
        $result = $item->getSell() * $count;
        $player->getInventory()->removeItem($itemClone);
        Money::getInstance()->getFunction($player)->addCurrency($item->getSell() * $count);
        return $result;
    }

}