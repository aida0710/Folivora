<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\other\register\enchant;

use pocketmine\data\bedrock\EnchantmentIdMap;
use pocketmine\data\bedrock\EnchantmentIds;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\ItemFlags;
use pocketmine\item\enchantment\Rarity;
use pocketmine\item\enchantment\StringToEnchantmentParser;

class Fortune {

    public const NAME = '幸運';
    public const REGISTER_NAME = 'fortune';

    public const RARITY = Rarity::RARE;
    public const MAX_LEVEL = 3;
    public const ITEM_FLAGS = ItemFlags::DIG;
    public const ITEM_FLAGS_SECOND = ItemFlags::SHEARS;

    public static function register(): void {
        $enchant = new Enchantment(self::NAME, self::RARITY, self::ITEM_FLAGS, self::ITEM_FLAGS_SECOND, self::MAX_LEVEL);
        EnchantmentIdMap::getInstance()->register(EnchantmentIds::FORTUNE, $enchant);
        StringToEnchantmentParser::getInstance()->register(self::REGISTER_NAME, fn () => $enchant);
    }

}