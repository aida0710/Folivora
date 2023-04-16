<?php

declare(strict_types = 1);

namespace lazyperson0710\ShopSystem\form\levelShop\future;

use pocketmine\utils\SingletonTrait;
use RuntimeException;

class ShopCategory {

	use SingletonTrait;

	public const CAT_CURRENCY = 'Currency';
	public const CAT_FOODS = 'Foods';
	public const CAT_LOGS = 'Logs';
	public const CAT_ORES = 'Ores';
	public const CAT_NATURE_BLOCK = 'NatureBlock';
	public const CAT_TOOLS = 'Tools';
	public const CAT_CROP = 'Crop';
	public const CAT_FARMING_TOOLS = 'FarmingTools';
	public const CAT_SEEDS = 'Seeds';
	public const CAT_BUILDING_MATERIALS = 'BuildingMaterials';
	public const CAT_DYES = 'Dyes';
	public const CAT_OTHER_BLOCKS = 'OtherBlocks';
	public const CAT_ELYTRA = 'Elytra';
	public const CAT_WEAPON = 'Weapon';
	public const CAT_OTHER_ITEMS = 'OtherItems';
	public const CAT_HEADS = 'Heads';
	public const CAT_VEGETATION = 'Vegetation';
	public const CAT_RED_STONE = 'RedStone';

	public function getCategoryByDisplayName(string $categoryName) : string {
		return match ($categoryName) {
			self::CAT_CURRENCY => '換金アイテム',
			self::CAT_FOODS => '食べ物',
			self::CAT_LOGS => '原木',
			self::CAT_ORES => '鉱物',
			self::CAT_NATURE_BLOCK => '天然資源ブロック',
			self::CAT_TOOLS => 'ツール',
			self::CAT_CROP => '作物',
			self::CAT_FARMING_TOOLS => '農耕具',
			self::CAT_SEEDS => '作物種',
			self::CAT_BUILDING_MATERIALS => '建材',
			self::CAT_DYES => '染料',
			self::CAT_OTHER_BLOCKS => 'その他ブロック',
			self::CAT_ELYTRA => 'エリトラ',
			self::CAT_WEAPON => '武器',
			self::CAT_OTHER_ITEMS => 'その他アイテム',
			self::CAT_HEADS => 'モブヘッド',
			self::CAT_RED_STONE => 'レッドストーン',
			default => throw new RuntimeException('Invalid category name'),
		};
	}

}
