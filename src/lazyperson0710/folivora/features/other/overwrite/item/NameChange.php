<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\other\Overwrite\item;

use pocketmine\inventory\CreativeInventory;
use pocketmine\item\CookedChicken;
use pocketmine\item\CookedFish;
use pocketmine\item\CookedMutton;
use pocketmine\item\CookedPorkchop;
use pocketmine\item\CookedRabbit;
use pocketmine\item\CookedSalmon;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\StringToItemParser;
use pocketmine\item\VanillaItems;

class NameChange {

    public const ITEM_GRIND_STONE = -195;
    public const ITEM_COMMAND_BLOCK = 137;
    public const ITEM_CHISELED_NETHER_BRICKS = -302;

    public function init() : void {
        ItemFactory::getInstance()->register(new Item(new ItemIdentifier(self::ITEM_GRIND_STONE, 0), 'Login Bonus'));
        CreativeInventory::getInstance()->add(new Item(new ItemIdentifier(self::ITEM_GRIND_STONE, 0), 'Login Bonus'));
        StringToItemParser::getInstance()->register('grindstone', fn (string $input) => new Item(new ItemIdentifier(self::ITEM_GRIND_STONE, 0), 'Login Bonus'));
        ItemFactory::getInstance()->register(new Item(new ItemIdentifier(self::ITEM_COMMAND_BLOCK, 0), 'コマンドブロック'));
        CreativeInventory::getInstance()->add(new Item(new ItemIdentifier(self::ITEM_COMMAND_BLOCK, 0), 'コマンドブロック'));
        StringToItemParser::getInstance()->register('command_block', fn (string $input) => new Item(new ItemIdentifier(self::ITEM_COMMAND_BLOCK, 0), 'コマンドブロック'));
        ItemFactory::getInstance()->register(new Item(new ItemIdentifier(self::ITEM_CHISELED_NETHER_BRICKS, 0), 'MiningToolsRangeCostItem'));
        CreativeInventory::getInstance()->add(new Item(new ItemIdentifier(self::ITEM_CHISELED_NETHER_BRICKS, 0), 'MiningToolsRangeCostItem'));
        StringToItemParser::getInstance()->register('MiningToolsRangeCostItem', fn (string $input) => new Item(new ItemIdentifier(self::ITEM_CHISELED_NETHER_BRICKS, 0), 'MiningToolsRangeCostItem'));
        /*その他*/
        ItemFactory::getInstance()->register(new CookedMutton(new ItemIdentifier(VanillaItems::COOKED_MUTTON()->getId(), 0), '猫用チュール'), true);
        StringToItemParser::getInstance()->register('猫用チュール', fn () => (new CookedMutton(new ItemIdentifier(VanillaItems::COOKED_MUTTON()->getId(), 0), '猫用チュール')));
        ItemFactory::getInstance()->register(new CookedChicken(new ItemIdentifier(VanillaItems::COOKED_CHICKEN()->getId(), 0), '犬用チュール'), true);
        StringToItemParser::getInstance()->register('犬用チュール', fn () => (new CookedChicken(new ItemIdentifier(VanillaItems::COOKED_CHICKEN()->getId(), 0), '犬用チュール')));
        ItemFactory::getInstance()->register(new CookedSalmon(new ItemIdentifier(VanillaItems::COOKED_SALMON()->getId(), 0), 'かき氷'), true);
        StringToItemParser::getInstance()->register('かき氷', fn () => (new CookedSalmon(new ItemIdentifier(VanillaItems::COOKED_SALMON()->getId(), 0), 'かき氷')));
        ItemFactory::getInstance()->register(new CookedFish(new ItemIdentifier(VanillaItems::COOKED_FISH()->getId(), 0), 'ラムネ'), true);
        StringToItemParser::getInstance()->register('ラムネ', fn () => (new CookedFish(new ItemIdentifier(VanillaItems::COOKED_FISH()->getId(), 0), 'ラムネ')));
        ItemFactory::getInstance()->register(new CookedPorkchop(new ItemIdentifier(VanillaItems::COOKED_PORKCHOP()->getId(), 0), 'アメリカンドック'), true);
        StringToItemParser::getInstance()->register('アメリカンドック', fn () => (new CookedPorkchop(new ItemIdentifier(VanillaItems::COOKED_PORKCHOP()->getId(), 0), 'アメリカンドック')));
        ItemFactory::getInstance()->register(new CookedRabbit(new ItemIdentifier(VanillaItems::COOKED_RABBIT()->getId(), 0), 'モンスター'), true);
        StringToItemParser::getInstance()->register('モンスター', fn () => (new CookedRabbit(new ItemIdentifier(VanillaItems::COOKED_RABBIT()->getId(), 0), 'モンスター')));
    }

}
