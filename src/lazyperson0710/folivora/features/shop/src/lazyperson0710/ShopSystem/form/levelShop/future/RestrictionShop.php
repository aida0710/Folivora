<?php

declare(strict_types = 1);

namespace lazyperson0710\ShopSystem\form\levelShop\future;

use pocketmine\utils\SingletonTrait;
use RuntimeException;

class RestrictionShop {

	use SingletonTrait;

	public const RESTRICTION_LEVEL_OTHER_SHOP = 35;
	public const RESTRICTION_LEVEL_SHOP_1 = 0;
	public const RESTRICTION_LEVEL_SHOP_2 = 25;
	public const RESTRICTION_LEVEL_SHOP_3 = 50;
	public const RESTRICTION_LEVEL_SHOP_4 = 80;
	public const RESTRICTION_LEVEL_SHOP_5 = 120;
	public const RESTRICTION_LEVEL_SHOP_6 = 180;
	public const RESTRICTION_LEVEL_SHOP_7 = 250;

	public const OTHER_SHOP = 0;
	public const SHOP_1 = 1;
	public const SHOP_2 = 2;
	public const SHOP_3 = 3;
	public const SHOP_4 = 4;
	public const SHOP_5 = 5;
	public const SHOP_6 = 6;
	public const SHOP_7 = 7;

	public const ALL_SHOP = [
		self::OTHER_SHOP,
		self::SHOP_1,
		self::SHOP_2,
		self::SHOP_3,
		self::SHOP_4,
		self::SHOP_5,
		self::SHOP_6,
		self::SHOP_7,
	];

	public function checkShopId(int $shopId) : bool {
		foreach (self::ALL_SHOP as $shop) {
			if ($shop !== $shopId) return false;
		}
		return true;
	}

	public function getRestrictionByShopNumber(int $shopNumber) : int {
		return match ($shopNumber) {
			self::OTHER_SHOP => self::RESTRICTION_LEVEL_OTHER_SHOP,
			self::SHOP_1 => self::RESTRICTION_LEVEL_SHOP_1,
			self::SHOP_2 => self::RESTRICTION_LEVEL_SHOP_2,
			self::SHOP_3 => self::RESTRICTION_LEVEL_SHOP_3,
			self::SHOP_4 => self::RESTRICTION_LEVEL_SHOP_4,
			self::SHOP_5 => self::RESTRICTION_LEVEL_SHOP_5,
			self::SHOP_6 => self::RESTRICTION_LEVEL_SHOP_6,
			self::SHOP_7 => self::RESTRICTION_LEVEL_SHOP_7,
			default => throw new RuntimeException('Invalid shop number'),
		};
	}

	public function getShopNumberByRestriction(int $restrictionLevel) : int {
		return match ($restrictionLevel) {
			self::RESTRICTION_LEVEL_OTHER_SHOP => self::OTHER_SHOP,
			self::RESTRICTION_LEVEL_SHOP_1 => self::SHOP_1,
			self::RESTRICTION_LEVEL_SHOP_2 => self::SHOP_2,
			self::RESTRICTION_LEVEL_SHOP_3 => self::SHOP_3,
			self::RESTRICTION_LEVEL_SHOP_4 => self::SHOP_4,
			self::RESTRICTION_LEVEL_SHOP_5 => self::SHOP_5,
			self::RESTRICTION_LEVEL_SHOP_6 => self::SHOP_6,
			self::RESTRICTION_LEVEL_SHOP_7 => self::SHOP_7,
			default => throw new RuntimeException('Invalid restriction level'),
		};
	}

}
