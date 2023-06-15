<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\other\listener;

use lazyperson0710\folivora\util\message\send_message\SendMessage;
use pocketmine\block\VanillaBlocks;
use pocketmine\event\inventory\CraftItemEvent;
use pocketmine\event\Listener;
use pocketmine\item\Durable;
use pocketmine\item\Food;
use pocketmine\item\VanillaItems;

class CraftCancel implements Listener {

    public function onCraft(CraftItemEvent $event) : void {
        $blocks = [
            VanillaBlocks::ACACIA_PRESSURE_PLATE()->asItem()->getVanillaName(),
            VanillaBlocks::ACTIVATOR_RAIL()->asItem()->getVanillaName(),
            VanillaBlocks::ANVIL()->asItem()->getVanillaName(),
            VanillaBlocks::BANNER()->asItem()->getVanillaName(),
            VanillaBlocks::BARREL()->asItem()->getVanillaName(),
            VanillaBlocks::BEACON()->asItem()->getVanillaName(),
            VanillaBlocks::BED()->asItem()->getVanillaName(),
            VanillaBlocks::BELL()->asItem()->getVanillaName(),
            VanillaBlocks::BIRCH_PRESSURE_PLATE()->asItem()->getVanillaName(),
            VanillaBlocks::BLAST_FURNACE()->asItem()->getVanillaName(),
            VanillaBlocks::BLUE_ICE()->asItem()->getVanillaName(),
            VanillaBlocks::BOOKSHELF()->asItem()->getVanillaName(),
            VanillaBlocks::BREWING_STAND()->asItem()->getVanillaName(),
            VanillaBlocks::COMPOUND_CREATOR()->asItem()->getVanillaName(),
            VanillaBlocks::DARK_OAK_PRESSURE_PLATE()->asItem()->getVanillaName(),
            VanillaBlocks::DAYLIGHT_SENSOR()->asItem()->getVanillaName(),
            VanillaBlocks::DETECTOR_RAIL()->asItem()->getVanillaName(),
            VanillaBlocks::DYED_SHULKER_BOX()->asItem()->getVanillaName(),
            VanillaBlocks::ELEMENT_CONSTRUCTOR()->asItem()->getVanillaName(),
            VanillaBlocks::EMERALD()->asItem()->getVanillaName(),
            VanillaBlocks::ENCHANTING_TABLE()->asItem()->getVanillaName(),
            VanillaBlocks::END_ROD()->asItem()->getVanillaName(),
            VanillaBlocks::ENDER_CHEST()->asItem()->getVanillaName(),
            VanillaBlocks::FLETCHING_TABLE()->asItem()->getVanillaName(),
            VanillaBlocks::FROSTED_ICE()->asItem()->getVanillaName(),
            VanillaBlocks::HOPPER()->asItem()->getVanillaName(),
            VanillaBlocks::ICE()->asItem()->getVanillaName(),
            VanillaBlocks::ITEM_FRAME()->asItem()->getVanillaName(),
            VanillaBlocks::JUKEBOX()->asItem()->getVanillaName(),
            VanillaBlocks::JUNGLE_PRESSURE_PLATE()->asItem()->getVanillaName(),
            VanillaBlocks::LAB_TABLE()->asItem()->getVanillaName(),
            VanillaBlocks::LECTERN()->asItem()->getVanillaName(),
            VanillaBlocks::LOOM()->asItem()->getVanillaName(),
            VanillaBlocks::MATERIAL_REDUCER()->asItem()->getVanillaName(),
            VanillaBlocks::NOTE_BLOCK()->asItem()->getVanillaName(),
            VanillaBlocks::OAK_PRESSURE_PLATE()->asItem()->getVanillaName(),
            VanillaBlocks::POWERED_RAIL()->asItem()->getVanillaName(),
            VanillaBlocks::RAIL()->asItem()->getVanillaName(),
            VanillaBlocks::REDSTONE_COMPARATOR()->asItem()->getVanillaName(),
            VanillaBlocks::REDSTONE_LAMP()->asItem()->getVanillaName(),
            VanillaBlocks::REDSTONE_REPEATER()->asItem()->getVanillaName(),
            VanillaBlocks::REDSTONE_TORCH()->asItem()->getVanillaName(),
            VanillaBlocks::SEA_LANTERN()->asItem()->getVanillaName(),
            VanillaBlocks::SHULKER_BOX()->asItem()->getVanillaName(),
            VanillaBlocks::SLIME()->asItem()->getVanillaName(),
            VanillaBlocks::SMOKER()->asItem()->getVanillaName(),
            VanillaBlocks::SPRUCE_PRESSURE_PLATE()->asItem()->getVanillaName(),
            VanillaBlocks::STONE_PRESSURE_PLATE()->asItem()->getVanillaName(),
            VanillaBlocks::STONECUTTER()->asItem()->getVanillaName(),
            VanillaBlocks::TNT()->asItem()->getVanillaName(),
            VanillaBlocks::TRAPPED_CHEST()->asItem()->getVanillaName(),
            VanillaBlocks::TRIPWIRE()->asItem()->getVanillaName(),
            VanillaBlocks::WEIGHTED_PRESSURE_PLATE_HEAVY()->asItem()->getVanillaName(),
            VanillaBlocks::WEIGHTED_PRESSURE_PLATE_LIGHT()->asItem()->getVanillaName(),
        ];
        $items = [
            VanillaItems::ACACIA_BOAT()->getVanillaName(),
            VanillaItems::ARROW()->getVanillaName(),
            VanillaItems::BIRCH_BOAT()->getVanillaName(),
            VanillaItems::BLACK_BED()->getVanillaName(),
            VanillaItems::BLAZE_POWDER()->getVanillaName(),
            VanillaItems::BLAZE_ROD()->getVanillaName(),
            VanillaItems::BLUE_BED()->getVanillaName(),
            VanillaItems::BROWN_BED()->getVanillaName(),
            VanillaItems::COMPASS()->getVanillaName(),
            VanillaItems::CYAN_BED()->getVanillaName(),
            VanillaItems::DARK_OAK_BOAT()->getVanillaName(),
            VanillaItems::EMERALD()->getVanillaName(),
            VanillaItems::ENCHANTED_GOLDEN_APPLE()->getVanillaName(),
            VanillaItems::GOLDEN_APPLE()->getVanillaName(),
            VanillaItems::GRAY_BED()->getVanillaName(),
            VanillaItems::GREEN_BED()->getVanillaName(),
            VanillaItems::GOLD_NUGGET()->getVanillaName(),
            VanillaItems::IRON_NUGGET()->getVanillaName(),
            VanillaItems::JUNGLE_BOAT()->getVanillaName(),
            VanillaItems::LEATHER()->getVanillaName(),
            VanillaItems::LIGHT_BLUE_BED()->getVanillaName(),
            VanillaItems::LIGHT_GRAY_BED()->getVanillaName(),
            VanillaItems::LIME_BED()->getVanillaName(),
            VanillaItems::MAGENTA_BED()->getVanillaName(),
            VanillaItems::MINECART()->getVanillaName(),
            VanillaItems::OAK_BOAT()->getVanillaName(),
            VanillaItems::ORANGE_BED()->getVanillaName(),
            VanillaItems::PAINTING()->getVanillaName(),
            VanillaItems::PAPER()->getVanillaName(),
            VanillaItems::PINK_BED()->getVanillaName(),
            VanillaItems::PURPLE_BED()->getVanillaName(),
            VanillaItems::RED_BED()->getVanillaName(),
            VanillaItems::SPRUCE_BOAT()->getVanillaName(),
            VanillaItems::SUGAR()->getVanillaName(),
            VanillaItems::WHITE_BED()->getVanillaName(),
            VanillaItems::YELLOW_BED()->getVanillaName(),
            VanillaItems::MAGMA_CREAM()->getVanillaName(),
            VanillaItems::CLOCK()->getVanillaName(),
            VanillaItems::BOOK()->getVanillaName(),
            VanillaItems::WRITABLE_BOOK()->getVanillaName(),
            VanillaItems::WRITTEN_BOOK()->getVanillaName(),
        ];
        $ids = [
            513, //shield
            -272, //リスポーン アンカー
            -269, //魂のランタン
            720, //キャンプファイヤー
            801, //魂のキャンプファイヤー
            -239, //ターゲット
            758, //chain
            -270, //ネザライトブロック
        ];
        foreach ($event->getOutputs() as $item) {
            $player = $event->getPlayer();
            if ($item instanceof Food) {
                $event->cancel();
                SendMessage::Send($event->getPlayer(), '食べ物をクラフトすることは出来ません。一部を除いてショップから購入が可能です', '§bCraftCancel', false);
            }
            if ($item instanceof Durable) {
                $event->cancel();
                SendMessage::Send($event->getPlayer(), '道具をクラフトすることは出来ません。一部を除いてショップから購入が可能です', '§bCraftCancel', false);
            }
            if (in_array($item->getVanillaName(), $blocks, true)) {
                $event->cancel();
                SendMessage::Send($event->getPlayer(), 'このアイテムをクラフトすることは出来ません。一部を除いてショップから購入が可能です', '§bCraftCancel', false);
            }
            if (in_array($item->getVanillaName(), $items, true)) {
                $event->cancel();
                SendMessage::Send($event->getPlayer(), 'このアイテムをクラフトすることは出来ません。一部を除いてショップから購入が可能です', '§bCraftCancel', false);
            }
            if (in_array($item->getId(), $ids, true)) {
                $event->cancel();
                SendMessage::Send($event->getPlayer(), 'このアイテムをクラフトすることは出来ません。一部を除いてショップから購入が可能です', '§bCraftCancel', false);
            }
            return;
        }
    }
}
