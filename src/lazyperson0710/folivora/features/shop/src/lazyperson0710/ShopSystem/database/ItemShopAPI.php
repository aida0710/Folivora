<?php

declare(strict_types = 1);

namespace lazyperson0710\ShopSystem\database;

use lazyperson0710\ShopSystem\form\levelShop\future\RestrictionShop;
use lazyperson0710\ShopSystem\form\levelShop\future\ShopCategory;
use lazyperson0710\ShopSystem\object\ShopItem;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\ItemFactory;
use pocketmine\item\VanillaItems;
use pocketmine\utils\SingletonTrait;
use RuntimeException;

class ItemShopAPI {

	use SingletonTrait;

	/** @var ShopItem[] */
	private array $items = [];
	/** @var array<string> */
	private array $displayName;
	/** @var ShopItem[] */
	private array $itemByDisplayName;
	/** @var ShopItem[] */
	private array $itemByVanillaName;

	public function init() : void {
		$this->register(new ShopItem(VanillaItems::NETHER_STAR(), 1000, 1000, RestrictionShop::SHOP_1, ShopCategory::CAT_CURRENCY, 'ネザースター', true));
		$this->register(new ShopItem(VanillaItems::STEAK(), 25, 15, RestrictionShop::SHOP_1, ShopCategory::CAT_FOODS, 'ステーキ', true));
		$this->register(new ShopItem(VanillaItems::BREAD(), 250, 15, RestrictionShop::SHOP_1, ShopCategory::CAT_FOODS, 'パン', true));
		$this->register(new ShopItem(VanillaBlocks::CAKE()->asItem(), 1500, 50, RestrictionShop::SHOP_1, ShopCategory::CAT_FOODS, 'ケーキ', true));
		$this->register(new ShopItem(VanillaBlocks::OAK_LOG()->asItem(), 25, 15, RestrictionShop::SHOP_1, ShopCategory::CAT_LOGS, 'オークの原木', true));
		$this->register(new ShopItem(VanillaBlocks::SPRUCE_LOG()->asItem(), 25, 15, RestrictionShop::SHOP_1, ShopCategory::CAT_LOGS, 'トウヒの原木', true));
		$this->register(new ShopItem(VanillaBlocks::BIRCH_LOG()->asItem(), 25, 15, RestrictionShop::SHOP_1, ShopCategory::CAT_LOGS, '白樺の原木', true));
		$this->register(new ShopItem(VanillaBlocks::JUNGLE_LOG()->asItem(), 25, 15, RestrictionShop::SHOP_1, ShopCategory::CAT_LOGS, 'ジャングルの原木', true));
		$this->register(new ShopItem(VanillaBlocks::ACACIA_LOG()->asItem(), 25, 15, RestrictionShop::SHOP_1, ShopCategory::CAT_LOGS, 'アカシアの原木', true));
		$this->register(new ShopItem(VanillaBlocks::DARK_OAK_LOG()->asItem(), 25, 15, RestrictionShop::SHOP_1, ShopCategory::CAT_LOGS, 'ダークオークの原木', true));
		$this->register(new ShopItem(VanillaItems::COAL(), 75, 15, RestrictionShop::SHOP_1, ShopCategory::CAT_ORES, '石炭', true));
		$this->register(new ShopItem(VanillaBlocks::IRON_ORE()->asItem(), 750, 150, RestrictionShop::SHOP_1, ShopCategory::CAT_ORES, '鉄鉱石', true));
		$this->register(new ShopItem(VanillaBlocks::GOLD_ORE()->asItem(), 750, 150, RestrictionShop::SHOP_1, ShopCategory::CAT_ORES, '金鉱石', true));
		$this->register(new ShopItem(VanillaItems::IRON_INGOT(), 900, 180, RestrictionShop::SHOP_1, ShopCategory::CAT_ORES, '鉄インゴット', true));
		$this->register(new ShopItem(VanillaItems::GOLD_INGOT(), 900, 180, RestrictionShop::SHOP_1, ShopCategory::CAT_ORES, '金インゴット', true));
		$this->register(new ShopItem(VanillaItems::LAPIS_LAZULI(), 750, 80, RestrictionShop::SHOP_1, ShopCategory::CAT_ORES, 'ラピスラズリ', true));
		$this->register(new ShopItem(VanillaItems::REDSTONE_DUST(), 75, 15, RestrictionShop::SHOP_1, ShopCategory::CAT_ORES, 'レッドストーン', true));
		$this->register(new ShopItem(VanillaItems::DIAMOND(), 4500, 800, RestrictionShop::SHOP_1, ShopCategory::CAT_ORES, 'ダイヤモンド', true));
		$this->register(new ShopItem(VanillaItems::EMERALD(), 15000, 3000, RestrictionShop::SHOP_1, ShopCategory::CAT_ORES, 'エメラルド', true));
		$this->register(new ShopItem(VanillaItems::WRITABLE_BOOK(), 50, 1, RestrictionShop::SHOP_1, ShopCategory::CAT_OTHER_ITEMS, '本と羽根ペン', true));
		$this->register(new ShopItem(VanillaBlocks::DIRT()->asItem(), 25, 1, RestrictionShop::SHOP_1, ShopCategory::CAT_NATURE_BLOCK, '土', true));
		$this->register(new ShopItem(VanillaBlocks::STONE()->asItem(), 25, 5, RestrictionShop::SHOP_1, ShopCategory::CAT_NATURE_BLOCK, '石', true));
		$this->register(new ShopItem(VanillaBlocks::COBBLESTONE()->asItem(), 25, 3, RestrictionShop::SHOP_1, ShopCategory::CAT_NATURE_BLOCK, '丸石', true));
		$this->register(new ShopItem(VanillaBlocks::GRANITE()->asItem(), 25, 3, RestrictionShop::SHOP_1, ShopCategory::CAT_NATURE_BLOCK, '花崗岩', true));
		$this->register(new ShopItem(VanillaBlocks::DIORITE()->asItem(), 25, 3, RestrictionShop::SHOP_1, ShopCategory::CAT_NATURE_BLOCK, '閃緑岩', true));
		$this->register(new ShopItem(VanillaBlocks::ANDESITE()->asItem(), 25, 3, RestrictionShop::SHOP_1, ShopCategory::CAT_NATURE_BLOCK, '安山岩', true));
		$this->register(new ShopItem(VanillaBlocks::SAND()->asItem(), 15, 1, RestrictionShop::SHOP_1, ShopCategory::CAT_NATURE_BLOCK, '砂', true));
		$this->register(new ShopItem(VanillaBlocks::SANDSTONE()->asItem(), 15, 1, RestrictionShop::SHOP_1, ShopCategory::CAT_NATURE_BLOCK, '砂岩', true));
		$this->register(new ShopItem(VanillaBlocks::GRAVEL()->asItem(), 15, 1, RestrictionShop::SHOP_1, ShopCategory::CAT_NATURE_BLOCK, '砂利', true));
		$this->register(new ShopItem(VanillaItems::IRON_PICKAXE(), 150, 0, RestrictionShop::SHOP_1, ShopCategory::CAT_TOOLS, '鉄のピッケル', true));
		$this->register(new ShopItem(VanillaItems::IRON_SHOVEL(), 150, 0, RestrictionShop::SHOP_1, ShopCategory::CAT_TOOLS, '鉄のシャベル', true));
		$this->register(new ShopItem(VanillaItems::IRON_AXE(), 150, 0, RestrictionShop::SHOP_1, ShopCategory::CAT_TOOLS, '鉄の斧', true));
		$this->register(new ShopItem(VanillaItems::DIAMOND_PICKAXE(), 250, 0, RestrictionShop::SHOP_1, ShopCategory::CAT_TOOLS, 'ダイヤモンドのピッケル', true));
		$this->register(new ShopItem(VanillaItems::DIAMOND_SHOVEL(), 250, 0, RestrictionShop::SHOP_1, ShopCategory::CAT_TOOLS, 'ダイヤモンドのシャベル', true));
		$this->register(new ShopItem(VanillaItems::DIAMOND_AXE(), 250, 0, RestrictionShop::SHOP_1, ShopCategory::CAT_TOOLS, 'ダイヤモンドの斧', true));
		$this->register(new ShopItem(VanillaItems::SHEARS(), 15000, 0, RestrictionShop::SHOP_1, ShopCategory::CAT_TOOLS, 'はさみ', true));
		/*Shop2*/
		$this->register(new ShopItem(VanillaItems::WHEAT(), 250, 8, RestrictionShop::SHOP_2, ShopCategory::CAT_CROP, '小麦', true));
		$this->register(new ShopItem(VanillaItems::POTATO(), 250, 8, RestrictionShop::SHOP_2, ShopCategory::CAT_CROP, 'ジャガイモ', true));
		$this->register(new ShopItem(VanillaItems::CARROT(), 250, 8, RestrictionShop::SHOP_2, ShopCategory::CAT_CROP, 'ニンジン', true));
		$this->register(new ShopItem(VanillaItems::BEETROOT(), 250, 8, RestrictionShop::SHOP_2, ShopCategory::CAT_CROP, 'ビートルート', true));
		$this->register(new ShopItem(VanillaItems::SWEET_BERRIES(), 250, 8, RestrictionShop::SHOP_2, ShopCategory::CAT_CROP, 'スイートベリー', true));
		$this->register(new ShopItem(VanillaBlocks::BAMBOO()->asItem(), 250, 4, RestrictionShop::SHOP_2, ShopCategory::CAT_CROP, '竹', true));
		$this->register(new ShopItem(VanillaBlocks::SUGARCANE()->asItem(), 250, 4, RestrictionShop::SHOP_2, ShopCategory::CAT_CROP, 'サトウキビ', true));
		$this->register(new ShopItem(VanillaItems::APPLE(), 250, 8, RestrictionShop::SHOP_2, ShopCategory::CAT_CROP, 'リンゴ', true));
		$this->register(new ShopItem(VanillaBlocks::MELON()->asItem(), 500, 6, RestrictionShop::SHOP_2, ShopCategory::CAT_CROP, 'スイカ', true));
		$this->register(new ShopItem(VanillaBlocks::PUMPKIN()->asItem(), 500, 6, RestrictionShop::SHOP_2, ShopCategory::CAT_CROP, 'カボチャ', true));
		$this->register(new ShopItem(VanillaBlocks::WATER()->asItem(), 800, 150, RestrictionShop::SHOP_2, ShopCategory::CAT_FARMING_TOOLS, '水ブロック', true));
		$this->register(new ShopItem(VanillaBlocks::FARMLAND()->asItem(), 50, 1, RestrictionShop::SHOP_2, ShopCategory::CAT_FARMING_TOOLS, '農地ブロック', true));
		$this->register(new ShopItem(VanillaItems::DIAMOND_HOE(), 15000, 0, RestrictionShop::SHOP_2, ShopCategory::CAT_FARMING_TOOLS, 'ダイヤモンドのクワ', true));
		$this->register(new ShopItem(VanillaItems::WHEAT_SEEDS(), 250, 3, RestrictionShop::SHOP_2, ShopCategory::CAT_SEEDS, '小麦の種', true));
		$this->register(new ShopItem(VanillaItems::BEETROOT_SEEDS(), 250, 3, RestrictionShop::SHOP_2, ShopCategory::CAT_SEEDS, 'ビートルートの種', true));
		$this->register(new ShopItem(VanillaItems::PUMPKIN_SEEDS(), 250, 3, RestrictionShop::SHOP_2, ShopCategory::CAT_SEEDS, 'カボチャの種', true));
		$this->register(new ShopItem(VanillaItems::MELON_SEEDS(), 250, 3, RestrictionShop::SHOP_2, ShopCategory::CAT_SEEDS, 'スイカの種', true));
		/*Shop3*/
		$this->register(new ShopItem(VanillaBlocks::STONE_BRICKS()->asItem(), 25, 5, RestrictionShop::SHOP_3, ShopCategory::CAT_BUILDING_MATERIALS, '石レンガ', true));
		$this->register(new ShopItem(VanillaBlocks::BRICKS()->asItem(), 25, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_BUILDING_MATERIALS, 'レンガ', true));
		$this->register(new ShopItem(VanillaBlocks::QUARTZ()->asItem(), 25, 5, RestrictionShop::SHOP_3, ShopCategory::CAT_BUILDING_MATERIALS, 'クォーツブロック', true));
		$this->register(new ShopItem(VanillaBlocks::GLASS()->asItem(), 25, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_BUILDING_MATERIALS, 'ガラス', true));
		$this->register(new ShopItem(VanillaBlocks::WOOL()->asItem(), 25, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_BUILDING_MATERIALS, '羊毛', true));
		$this->register(new ShopItem(VanillaBlocks::PRISMARINE()->asItem(), 25, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_BUILDING_MATERIALS, 'プリズマリン', true));
		$this->register(new ShopItem(VanillaBlocks::PRISMARINE_BRICKS()->asItem(), 25, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_BUILDING_MATERIALS, 'プリズマリンレンガ', true));
		$this->register(new ShopItem(VanillaBlocks::DARK_PRISMARINE()->asItem(), 25, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_BUILDING_MATERIALS, 'ダークプリズマリン', true));
		$this->register(new ShopItem(VanillaBlocks::HARDENED_CLAY()->asItem(), 25, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_BUILDING_MATERIALS, 'テラコッタ', true));
		$this->register(new ShopItem(VanillaBlocks::PURPUR()->asItem(), 25, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_BUILDING_MATERIALS, 'プルプァブロック', true));
		$this->register(new ShopItem(VanillaBlocks::CLAY()->asItem(), 25, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_BUILDING_MATERIALS, '粘土ブロック', true));
		$this->register(new ShopItem(VanillaBlocks::NETHERRACK()->asItem(), 50, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_BUILDING_MATERIALS, 'ネザーラック', true));
		$this->register(new ShopItem(VanillaBlocks::END_STONE()->asItem(), 50, 3, RestrictionShop::SHOP_3, ShopCategory::CAT_BUILDING_MATERIALS, 'エンドストーン', true));
		$this->register(new ShopItem(VanillaBlocks::GLOWSTONE()->asItem(), 150, 15, RestrictionShop::SHOP_3, ShopCategory::CAT_BUILDING_MATERIALS, 'グロウストーン', true));
		$this->register(new ShopItem(VanillaBlocks::SEA_LANTERN()->asItem(), 150, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_BUILDING_MATERIALS, 'シーランタン', true));
		$this->register(new ShopItem(VanillaBlocks::RED_SAND()->asItem(), 25, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_BUILDING_MATERIALS, '赤い砂', true));
		$this->register(new ShopItem(VanillaBlocks::RED_SANDSTONE()->asItem(), 30, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_BUILDING_MATERIALS, '赤い砂岩', true));
		$this->register(new ShopItem(VanillaItems::WHITE_DYE(), 5, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_DYES, '白色の染料', true));
		$this->register(new ShopItem(VanillaItems::LIGHT_GRAY_DYE(), 5, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_DYES, '薄灰色の染料', true));
		$this->register(new ShopItem(VanillaItems::GRAY_DYE(), 5, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_DYES, '灰色の染料', true));
		$this->register(new ShopItem(VanillaItems::BLACK_DYE(), 5, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_DYES, '黒色の染料', true));
		$this->register(new ShopItem(VanillaItems::BROWN_DYE(), 5, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_DYES, '茶色の染料', true));
		$this->register(new ShopItem(VanillaItems::RED_DYE(), 5, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_DYES, '赤色の染料', true));
		$this->register(new ShopItem(VanillaItems::ORANGE_DYE(), 5, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_DYES, '橙色の染料', true));
		$this->register(new ShopItem(VanillaItems::YELLOW_DYE(), 5, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_DYES, '黄色の染料', true));
		$this->register(new ShopItem(VanillaItems::LIME_DYE(), 5, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_DYES, '黄緑色の染料', true));
		$this->register(new ShopItem(VanillaItems::GREEN_DYE(), 5, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_DYES, '緑色の染料', true));
		$this->register(new ShopItem(VanillaItems::CYAN_DYE(), 5, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_DYES, '青緑色の染料', true));
		$this->register(new ShopItem(VanillaItems::LIGHT_BLUE_DYE(), 5, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_DYES, '空色の染料', true));
		$this->register(new ShopItem(VanillaItems::BLUE_DYE(), 5, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_DYES, '青色の染料', true));
		$this->register(new ShopItem(VanillaItems::PURPLE_DYE(), 5, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_DYES, '紫色の染料', true));
		$this->register(new ShopItem(VanillaItems::MAGENTA_DYE(), 5, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_DYES, '赤紫色の染料', true));
		$this->register(new ShopItem(VanillaItems::PINK_DYE(), 5, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_DYES, '桃色の染料', true));
		$this->register(new ShopItem(VanillaBlocks::COAL_ORE()->asItem(), 50000, 15, RestrictionShop::SHOP_3, ShopCategory::CAT_ORES, '石炭鉱石', true));
		$this->register(new ShopItem(VanillaBlocks::LAPIS_LAZULI_ORE()->asItem(), 50000, 40, RestrictionShop::SHOP_3, ShopCategory::CAT_ORES, 'ラピスラズリ鉱石', true));
		$this->register(new ShopItem(VanillaBlocks::REDSTONE_ORE()->asItem(), 50000, 15, RestrictionShop::SHOP_3, ShopCategory::CAT_ORES, 'レッドストーン鉱石', true));
		$this->register(new ShopItem(VanillaBlocks::DIAMOND_ORE()->asItem(), 50000, 800, RestrictionShop::SHOP_3, ShopCategory::CAT_ORES, 'ダイヤモンド鉱石', true));
		$this->register(new ShopItem(VanillaBlocks::NETHER_QUARTZ_ORE()->asItem(), 50000, 30, RestrictionShop::SHOP_3, ShopCategory::CAT_ORES, 'ネザークォーツ鉱石', true));
		$this->register(new ShopItem(VanillaBlocks::EMERALD_ORE()->asItem(), 50000, 3000, RestrictionShop::SHOP_3, ShopCategory::CAT_ORES, 'エメラルド鉱石', true));
		$this->register(new ShopItem(VanillaBlocks::PACKED_ICE()->asItem(), 50, 0, RestrictionShop::SHOP_3, ShopCategory::CAT_OTHER_BLOCKS, '氷塊', true));
		$this->register(new ShopItem(VanillaBlocks::OBSIDIAN()->asItem(), 50, 5, RestrictionShop::SHOP_3, ShopCategory::CAT_OTHER_BLOCKS, '黒曜石', true));
		$this->register(new ShopItem(VanillaBlocks::END_ROD()->asItem(), 50, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_OTHER_BLOCKS, 'エンドロッド', true));
		$this->register(new ShopItem(VanillaBlocks::ANVIL()->asItem(), 150, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_OTHER_BLOCKS, 'かなとこ', true));
		$this->register(new ShopItem(VanillaBlocks::SHULKER_BOX()->asItem(), 3000, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_OTHER_BLOCKS, 'シュルカーボックス', true));
		$this->register(new ShopItem(VanillaBlocks::SLIME()->asItem(), 50, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_OTHER_BLOCKS, 'スライムブロック', true));
		$this->register(new ShopItem(VanillaBlocks::BOOKSHELF()->asItem(), 50, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_OTHER_BLOCKS, '本棚', true));
		$this->register(new ShopItem(VanillaBlocks::COBWEB()->asItem(), 50, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_OTHER_BLOCKS, 'クモの巣', true));
		$this->register(new ShopItem(VanillaBlocks::BLAST_FURNACE()->asItem(), 250, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_OTHER_BLOCKS, '溶鉱炉', true));
		$this->register(new ShopItem(VanillaBlocks::SMOKER()->asItem(), 250, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_OTHER_BLOCKS, '燻製器', true));
		$this->register(new ShopItem(VanillaBlocks::LECTERN()->asItem(), 2500, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_OTHER_BLOCKS, '書見台', true));
		$this->register(new ShopItem(VanillaBlocks::RAIL()->asItem(), 300, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_OTHER_BLOCKS, 'レール ', false));
		$this->register(new ShopItem(VanillaBlocks::POWERED_RAIL()->asItem(), 300, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_OTHER_BLOCKS, '加速レール ', false));
		$this->register(new ShopItem(VanillaBlocks::ACTIVATOR_RAIL()->asItem(), 300, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_OTHER_BLOCKS, '感知レール ', false));
		$this->register(new ShopItem(VanillaBlocks::DETECTOR_RAIL()->asItem(), 300, 1, RestrictionShop::SHOP_3, ShopCategory::CAT_OTHER_BLOCKS, 'アクティベーター レール ', false));
		/*Shop4*/
		$this->register(new ShopItem(ItemFactory::getInstance()->get(444), 3500000, 0, RestrictionShop::SHOP_4, ShopCategory::CAT_ELYTRA, 'エリトラ', true));
		$this->register(new ShopItem(VanillaBlocks::GRASS()->asItem(), 10, 1, RestrictionShop::SHOP_4, ShopCategory::CAT_OTHER_BLOCKS, '草ブロック', true));
		$this->register(new ShopItem(VanillaBlocks::PODZOL()->asItem(), 10, 1, RestrictionShop::SHOP_4, ShopCategory::CAT_OTHER_BLOCKS, 'ポドゾル', true));
		$this->register(new ShopItem(VanillaBlocks::MYCELIUM()->asItem(), 10, 1, RestrictionShop::SHOP_4, ShopCategory::CAT_OTHER_BLOCKS, '菌糸ブロック', true));
		$this->register(new ShopItem(VanillaBlocks::MOSSY_COBBLESTONE()->asItem(), 10, 1, RestrictionShop::SHOP_4, ShopCategory::CAT_OTHER_BLOCKS, '苔むした丸石', true));
		$this->register(new ShopItem(VanillaBlocks::SMOOTH_STONE()->asItem(), 10, 3, RestrictionShop::SHOP_4, ShopCategory::CAT_OTHER_BLOCKS, '滑らかな石', true));
		$this->register(new ShopItem(VanillaBlocks::SMOOTH_QUARTZ()->asItem(), 10, 3, RestrictionShop::SHOP_4, ShopCategory::CAT_OTHER_BLOCKS, '滑らかなクォーツブロック', true));
		$this->register(new ShopItem(VanillaBlocks::SMOOTH_SANDSTONE()->asItem(), 10, 1, RestrictionShop::SHOP_4, ShopCategory::CAT_OTHER_BLOCKS, '滑らかな砂岩', true));
		$this->register(new ShopItem(VanillaBlocks::SMOOTH_RED_SANDSTONE()->asItem(), 10, 1, RestrictionShop::SHOP_4, ShopCategory::CAT_OTHER_BLOCKS, '滑らかな赤い砂岩', true));
		$this->register(new ShopItem(VanillaItems::IRON_SWORD(), 300, 0, RestrictionShop::SHOP_4, ShopCategory::CAT_WEAPON, '鉄の剣', true));
		$this->register(new ShopItem(VanillaItems::DIAMOND_SWORD(), 800, 0, RestrictionShop::SHOP_4, ShopCategory::CAT_WEAPON, 'ダイヤモンドの剣', true));
		$this->register(new ShopItem(VanillaItems::BOW(), 500, 0, RestrictionShop::SHOP_4, ShopCategory::CAT_WEAPON, '弓', true));
		$this->register(new ShopItem(VanillaItems::ARROW(), 50, 0, RestrictionShop::SHOP_4, ShopCategory::CAT_WEAPON, '矢', true));
		$this->register(new ShopItem(VanillaItems::SNOWBALL(), 15, 0, RestrictionShop::SHOP_4, ShopCategory::CAT_WEAPON, '雪玉', true));
		$this->register(new ShopItem(VanillaItems::EGG(), 10, 1, RestrictionShop::SHOP_4, ShopCategory::CAT_WEAPON, '卵', true));
		$this->register(new ShopItem(ItemFactory::getInstance()->get(513), 500, 0, RestrictionShop::SHOP_4, ShopCategory::CAT_WEAPON, '盾', true));
		$this->register(new ShopItem(ItemFactory::getInstance()->get(772), 300000, 0, RestrictionShop::SHOP_4, ShopCategory::CAT_WEAPON, '望遠鏡', true));
		/*Shop5*/
		$this->register(new ShopItem(ItemFactory::getInstance()->get(-273), 50, 0, RestrictionShop::SHOP_5, ShopCategory::CAT_BUILDING_MATERIALS, 'ブラックストーン', true));
		$this->register(new ShopItem(ItemFactory::getInstance()->get(-234), 50, 0, RestrictionShop::SHOP_5, ShopCategory::CAT_BUILDING_MATERIALS, '玄武岩', true));
		$this->register(new ShopItem(ItemFactory::getInstance()->get(-225), 50, 0, RestrictionShop::SHOP_5, ShopCategory::CAT_BUILDING_MATERIALS, '真紅の幹', true));
		$this->register(new ShopItem(ItemFactory::getInstance()->get(-226), 50, 0, RestrictionShop::SHOP_5, ShopCategory::CAT_BUILDING_MATERIALS, '歪んだ幹', true));
		$this->register(new ShopItem(VanillaBlocks::SOUL_SAND()->asItem(), 250, 3, RestrictionShop::SHOP_5, ShopCategory::CAT_OTHER_BLOCKS, 'ソウルサンド', true));
		$this->register(new ShopItem(ItemFactory::getInstance()->get(-236), 50, 0, RestrictionShop::SHOP_5, ShopCategory::CAT_OTHER_BLOCKS, 'ソウルソイル', true));
		$this->register(new ShopItem(ItemFactory::getInstance()->get(-232), 50, 0, RestrictionShop::SHOP_5, ShopCategory::CAT_BUILDING_MATERIALS, '真紅のナイリウム', true));
		$this->register(new ShopItem(ItemFactory::getInstance()->get(-233), 50, 0, RestrictionShop::SHOP_5, ShopCategory::CAT_BUILDING_MATERIALS, '歪んだナイリウム', true));
		$this->register(new ShopItem(VanillaBlocks::MAGMA()->asItem(), 50, 1, RestrictionShop::SHOP_5, ShopCategory::CAT_BUILDING_MATERIALS, 'マグマブロック', true));
		$this->register(new ShopItem(ItemFactory::getInstance()->get(-230), 50, 0, RestrictionShop::SHOP_5, ShopCategory::CAT_BUILDING_MATERIALS, 'シュルームライト', true));
		$this->register(new ShopItem(VanillaBlocks::NETHER_WART_BLOCK()->asItem(), 50, 1, RestrictionShop::SHOP_5, ShopCategory::CAT_BUILDING_MATERIALS, 'ネザーウォートブロック', true));
		$this->register(new ShopItem(ItemFactory::getInstance()->get(-227), 50, 0, RestrictionShop::SHOP_5, ShopCategory::CAT_BUILDING_MATERIALS, '歪んだウォートブロック', true));
		$this->register(new ShopItem(ItemFactory::getInstance()->get(-289), 50, 0, RestrictionShop::SHOP_5, ShopCategory::CAT_BUILDING_MATERIALS, '泣く黒曜石', true));
		$this->register(new ShopItem(ItemFactory::getInstance()->get(-272), 50, 0, RestrictionShop::SHOP_5, ShopCategory::CAT_BUILDING_MATERIALS, 'リスポーンアンカー', false));
		$this->register(new ShopItem(VanillaItems::FLINT(), 25, 1, RestrictionShop::SHOP_5, ShopCategory::CAT_OTHER_ITEMS, '火打石', true));
		$this->register(new ShopItem(ItemFactory::getInstance()->get(-228), 50, 0, RestrictionShop::SHOP_5, ShopCategory::CAT_OTHER_ITEMS, '真紅のキノコ', true));
		$this->register(new ShopItem(ItemFactory::getInstance()->get(-229), 50, 0, RestrictionShop::SHOP_5, ShopCategory::CAT_OTHER_ITEMS, '歪んだキノコ', true));
		$this->register(new ShopItem(ItemFactory::getInstance()->get(-231), 50, 0, RestrictionShop::SHOP_5, ShopCategory::CAT_OTHER_ITEMS, 'しだれツタ', true));
		$this->register(new ShopItem(ItemFactory::getInstance()->get(-287), 50, 0, RestrictionShop::SHOP_5, ShopCategory::CAT_OTHER_ITEMS, 'ねじれツタ', true));
		$this->register(new ShopItem(ItemFactory::getInstance()->get(-223), 50, 0, RestrictionShop::SHOP_5, ShopCategory::CAT_OTHER_ITEMS, '真紅の根', true));
		$this->register(new ShopItem(ItemFactory::getInstance()->get(-224), 50, 0, RestrictionShop::SHOP_5, ShopCategory::CAT_OTHER_ITEMS, '歪んだ根', true));
		/*Shop6*/
		$this->register(new ShopItem(ItemFactory::getInstance()->get(-265), 50, 0, RestrictionShop::SHOP_6, ShopCategory::CAT_BUILDING_MATERIALS, '真紅の石', true));
		$this->register(new ShopItem(ItemFactory::getInstance()->get(720), 60000, 0, RestrictionShop::SHOP_6, ShopCategory::CAT_BUILDING_MATERIALS, '焚き火', true));
		$this->register(new ShopItem(ItemFactory::getInstance()->get(801), 60000, 0, RestrictionShop::SHOP_6, ShopCategory::CAT_BUILDING_MATERIALS, '魂の焚き火', true));
		$this->register(new ShopItem(ItemFactory::getInstance()->get(-268), 60, 0, RestrictionShop::SHOP_6, ShopCategory::CAT_BUILDING_MATERIALS, '魂の松明', true));
		$this->register(new ShopItem(VanillaBlocks::LANTERN()->asItem(), 50, 1, RestrictionShop::SHOP_6, ShopCategory::CAT_BUILDING_MATERIALS, 'ランタン', true));
		$this->register(new ShopItem(ItemFactory::getInstance()->get(-269), 60, 0, RestrictionShop::SHOP_6, ShopCategory::CAT_BUILDING_MATERIALS, '魂のランタン', true));
		$this->register(new ShopItem(VanillaBlocks::SEA_PICKLE()->asItem(), 50, 1, RestrictionShop::SHOP_6, ShopCategory::CAT_BUILDING_MATERIALS, 'シーピクルス', true));
		$this->register(new ShopItem(ItemFactory::getInstance()->get(758), 60, 0, RestrictionShop::SHOP_6, ShopCategory::CAT_BUILDING_MATERIALS, 'チェーン', true));
		$this->register(new ShopItem(VanillaBlocks::BELL()->asItem(), 150000, 1, RestrictionShop::SHOP_6, ShopCategory::CAT_BUILDING_MATERIALS, 'ベル', true));
		$this->register(new ShopItem(VanillaBlocks::BEACON()->asItem(), 300000, 1, RestrictionShop::SHOP_6, ShopCategory::CAT_BUILDING_MATERIALS, 'ビーコン ', false));
		$this->register(new ShopItem(VanillaItems::PLAYER_HEAD(), 800000, 1, RestrictionShop::SHOP_6, ShopCategory::CAT_HEADS, 'プレイヤーの頭', true));
		$this->register(new ShopItem(VanillaItems::ZOMBIE_HEAD(), 800000, 1, RestrictionShop::SHOP_6, ShopCategory::CAT_HEADS, 'ゾンビの頭', true));
		$this->register(new ShopItem(VanillaItems::SKELETON_SKULL(), 800000, 1, RestrictionShop::SHOP_6, ShopCategory::CAT_HEADS, 'スケルトンの頭蓋骨', true));
		$this->register(new ShopItem(VanillaItems::CREEPER_HEAD(), 800000, 1, RestrictionShop::SHOP_6, ShopCategory::CAT_HEADS, 'クリーパーの頭', true));
		$this->register(new ShopItem(VanillaItems::WITHER_SKELETON_SKULL(), 800000, 1, RestrictionShop::SHOP_6, ShopCategory::CAT_HEADS, 'ウィザースケルトンの頭蓋骨', true));
		$this->register(new ShopItem(VanillaItems::DRAGON_HEAD(), 1200000, 1, RestrictionShop::SHOP_6, ShopCategory::CAT_HEADS, 'エンダードラゴンの頭', true));
		$this->register(new ShopItem(VanillaBlocks::DANDELION()->asItem(), 30, 1, RestrictionShop::SHOP_6, ShopCategory::CAT_VEGETATION, 'タンポポ', true));
		$this->register(new ShopItem(VanillaBlocks::POPPY()->asItem(), 30, 1, RestrictionShop::SHOP_6, ShopCategory::CAT_VEGETATION, 'ポピー', true));
		$this->register(new ShopItem(VanillaBlocks::BLUE_ORCHID()->asItem(), 30, 1, RestrictionShop::SHOP_6, ShopCategory::CAT_VEGETATION, 'ヒスイラン', true));
		$this->register(new ShopItem(VanillaBlocks::ALLIUM()->asItem(), 30, 1, RestrictionShop::SHOP_6, ShopCategory::CAT_VEGETATION, 'アリウム', true));
		$this->register(new ShopItem(VanillaBlocks::AZURE_BLUET()->asItem(), 30, 1, RestrictionShop::SHOP_6, ShopCategory::CAT_VEGETATION, 'ヒナソウ', true));
		$this->register(new ShopItem(VanillaBlocks::RED_TULIP()->asItem(), 30, 1, RestrictionShop::SHOP_6, ShopCategory::CAT_VEGETATION, '赤のチューリップ', true));
		$this->register(new ShopItem(VanillaBlocks::ORANGE_TULIP()->asItem(), 30, 1, RestrictionShop::SHOP_6, ShopCategory::CAT_VEGETATION, '橙のチューリップ', true));
		$this->register(new ShopItem(VanillaBlocks::WHITE_TULIP()->asItem(), 30, 1, RestrictionShop::SHOP_6, ShopCategory::CAT_VEGETATION, '白のチューリップ', true));
		$this->register(new ShopItem(VanillaBlocks::PINK_TULIP()->asItem(), 30, 1, RestrictionShop::SHOP_6, ShopCategory::CAT_VEGETATION, '桃色のチューリップ', true));
		$this->register(new ShopItem(VanillaBlocks::OXEYE_DAISY()->asItem(), 30, 1, RestrictionShop::SHOP_6, ShopCategory::CAT_VEGETATION, 'フランスギク', true));
		$this->register(new ShopItem(VanillaBlocks::CORNFLOWER()->asItem(), 30, 1, RestrictionShop::SHOP_6, ShopCategory::CAT_VEGETATION, 'ヤグルマギク', true));
		$this->register(new ShopItem(VanillaBlocks::LILY_OF_THE_VALLEY()->asItem(), 30, 1, RestrictionShop::SHOP_6, ShopCategory::CAT_VEGETATION, 'スズラン', true));
		$this->register(new ShopItem(VanillaBlocks::LILAC()->asItem(), 30, 1, RestrictionShop::SHOP_6, ShopCategory::CAT_VEGETATION, 'ライラック', true));
		$this->register(new ShopItem(VanillaBlocks::ROSE_BUSH()->asItem(), 30, 1, RestrictionShop::SHOP_6, ShopCategory::CAT_VEGETATION, 'バラの低木', true));
		$this->register(new ShopItem(VanillaBlocks::PEONY()->asItem(), 30, 1, RestrictionShop::SHOP_6, ShopCategory::CAT_VEGETATION, 'ボタン', true));
		$this->register(new ShopItem(VanillaBlocks::FERN()->asItem(), 30, 1, RestrictionShop::SHOP_6, ShopCategory::CAT_VEGETATION, 'シダ', true));
		$this->register(new ShopItem(VanillaBlocks::LARGE_FERN()->asItem(), 30, 1, RestrictionShop::SHOP_6, ShopCategory::CAT_VEGETATION, '大きなシダ', true));
		$this->register(new ShopItem(VanillaBlocks::TALL_GRASS()->asItem(), 30, 1, RestrictionShop::SHOP_6, ShopCategory::CAT_VEGETATION, '草(wwww', true));
		$this->register(new ShopItem(VanillaBlocks::DOUBLE_TALLGRASS()->asItem(), 30, 1, RestrictionShop::SHOP_6, ShopCategory::CAT_VEGETATION, '背の高い草', true));
		$this->register(new ShopItem(VanillaBlocks::DEAD_BUSH()->asItem(), 30, 1, RestrictionShop::SHOP_6, ShopCategory::CAT_VEGETATION, '枯れ木', true));
		$this->register(new ShopItem(VanillaBlocks::LILY_PAD()->asItem(), 30, 1, RestrictionShop::SHOP_6, ShopCategory::CAT_VEGETATION, 'スイレンの葉', true));
		$this->register(new ShopItem(VanillaBlocks::VINES()->asItem(), 30, 1, RestrictionShop::SHOP_6, ShopCategory::CAT_VEGETATION, 'つた', true));
		/*Shop7*/
		$this->register(new ShopItem(VanillaBlocks::ITEM_FRAME()->asItem(), 25000, 1, RestrictionShop::SHOP_7, ShopCategory::CAT_BUILDING_MATERIALS, '額縁', true));
		$this->register(new ShopItem(VanillaBlocks::FLETCHING_TABLE()->asItem(), 25000, 1, RestrictionShop::SHOP_7, ShopCategory::CAT_BUILDING_MATERIALS, '矢細工台 ', false));
		$this->register(new ShopItem(VanillaBlocks::COMPOUND_CREATOR()->asItem(), 25000, 1, RestrictionShop::SHOP_7, ShopCategory::CAT_BUILDING_MATERIALS, '化合物作成機 ', false));
		$this->register(new ShopItem(VanillaBlocks::LOOM()->asItem(), 25000, 1, RestrictionShop::SHOP_7, ShopCategory::CAT_BUILDING_MATERIALS, '織機 ', false));
		$this->register(new ShopItem(VanillaBlocks::ELEMENT_CONSTRUCTOR()->asItem(), 25000, 1, RestrictionShop::SHOP_7, ShopCategory::CAT_BUILDING_MATERIALS, '元素構成機 ', false));
		$this->register(new ShopItem(VanillaBlocks::LAB_TABLE()->asItem(), 125000, 1, RestrictionShop::SHOP_7, ShopCategory::CAT_BUILDING_MATERIALS, '実験テーブル ', false));
		$this->register(new ShopItem(VanillaBlocks::MATERIAL_REDUCER()->asItem(), 25000, 1, RestrictionShop::SHOP_7, ShopCategory::CAT_BUILDING_MATERIALS, '物質還元器 ', false));
		$this->register(new ShopItem(VanillaBlocks::BREWING_STAND()->asItem(), 25000, 1, RestrictionShop::SHOP_7, ShopCategory::CAT_BUILDING_MATERIALS, '調合台 ', false));
		$this->register(new ShopItem(VanillaBlocks::ENCHANTING_TABLE()->asItem(), 25000, 1, RestrictionShop::SHOP_7, ShopCategory::CAT_BUILDING_MATERIALS, 'エンチャントテーブル ', false));
		$this->register(new ShopItem(VanillaBlocks::BARREL()->asItem(), 25000, 1, RestrictionShop::SHOP_7, ShopCategory::CAT_BUILDING_MATERIALS, '樽ブロック', true));
		$this->register(new ShopItem(VanillaBlocks::NOTE_BLOCK()->asItem(), 25000, 1, RestrictionShop::SHOP_7, ShopCategory::CAT_BUILDING_MATERIALS, '音符ブロック', true));
		$this->register(new ShopItem(VanillaBlocks::JUKEBOX()->asItem(), 25000, 1, RestrictionShop::SHOP_7, ShopCategory::CAT_BUILDING_MATERIALS, 'ジュークボックス', true));
		$this->register(new ShopItem(VanillaBlocks::EMERALD()->asItem(), 15000, 1, RestrictionShop::SHOP_7, ShopCategory::CAT_BUILDING_MATERIALS, 'エレベーターブロック', true));
		$this->register(new ShopItem(VanillaBlocks::DAYLIGHT_SENSOR()->asItem(), 25000, 1, RestrictionShop::SHOP_7, ShopCategory::CAT_RED_STONE, '日照センサー', true));
		$this->register(new ShopItem(VanillaBlocks::HOPPER()->asItem(), 25000, 1, RestrictionShop::SHOP_7, ShopCategory::CAT_RED_STONE, 'ホッパー', true));
		$this->register(new ShopItem(VanillaBlocks::TNT()->asItem(), 25000, 1, RestrictionShop::SHOP_7, ShopCategory::CAT_RED_STONE, 'TNTブロック ', false));
		$this->register(new ShopItem(ItemFactory::getInstance()->get(-239), 10, 1, RestrictionShop::SHOP_7, ShopCategory::CAT_RED_STONE, 'ターゲット ', false));
		$this->register(new ShopItem(VanillaBlocks::TRIPWIRE_HOOK()->asItem(), 25000, 1, RestrictionShop::SHOP_7, ShopCategory::CAT_RED_STONE, 'トリップワイヤーフック ', false));
		$this->register(new ShopItem(VanillaBlocks::TRAPPED_CHEST()->asItem(), 2500, 1, RestrictionShop::SHOP_7, ShopCategory::CAT_RED_STONE, 'トラップチェスト ', false));
		$this->register(new ShopItem(VanillaBlocks::REDSTONE_TORCH()->asItem(), 2500, 1, RestrictionShop::SHOP_7, ShopCategory::CAT_RED_STONE, 'レッドストーントーチ ', false));
		$this->register(new ShopItem(VanillaBlocks::REDSTONE_REPEATER()->asItem(), 2500, 1, RestrictionShop::SHOP_7, ShopCategory::CAT_RED_STONE, 'リピーター ', false));
		$this->register(new ShopItem(VanillaBlocks::REDSTONE_COMPARATOR()->asItem(), 2500, 1, RestrictionShop::SHOP_7, ShopCategory::CAT_RED_STONE, 'コンパレーター ', false));
	}

	public function getItems() : array {
		return $this->items;
	}

	public function getDisplayName() : array {
		return $this->displayName;
	}

	public function getItemByDisplayName(string $displayName) : ShopItem {
		return $this->itemByDisplayName[$displayName];
	}

	public function getCategory(int $shopId) : array {
		if (RestrictionShop::getInstance()->checkShopId($shopId)) throw new RuntimeException('存在しないショップIDが指定されました -> ' . $shopId);
		return $this->items[$shopId];
	}

	/**
	 * @return ShopItem[]
	 */
	public function getCategoryItems(int $shopId, string $category) : array {
		if (RestrictionShop::getInstance()->checkShopId($shopId)) throw new RuntimeException('存在しないショップIDが指定されました -> ' . $shopId);
		return $this->items[$shopId][$category];
	}

	private function register(ShopItem $item) : void {
		$this->items[$item->getShopId()][$item->getItemCategory()][] = $item;
		$this->displayName[] = $item->getDisplayName();
		$this->itemByVanillaName[] = $item;
		$this->itemByDisplayName[$item->getDisplayName()] = $item;
	}

}
