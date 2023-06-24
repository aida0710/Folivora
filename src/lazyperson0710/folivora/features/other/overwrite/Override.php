<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\other\overwrite;

use lazyperson0710\folivora\features\other\overwrite\block\RedStoneOreBlock;
use lazyperson0710\folivora\features\other\overwrite\block\VanillaSponge;
use lazyperson0710\folivora\features\other\overwrite\item\NameChange;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockFactory;
use pocketmine\block\BlockIdentifierFlattened as BIDFlattened;
use pocketmine\block\BlockLegacyIds as Ids;
use pocketmine\block\BlockToolType as ToolType;
use pocketmine\item\ToolTier;

class Override {

    public static function init(): void {
        BlockFactory::getInstance()->register(
            new RedStoneOreBlock(
                new BIDFlattened(
                    Ids::REDSTONE_ORE,
                    [Ids::LIT_REDSTONE_ORE],
                    0
                ),
                'Redstone Ore',
                new BlockBreakInfo(
                    3.0,
                    ToolType::PICKAXE,
                    ToolTier::IRON()->getHarvestLevel())
            ), true);
        BlockFactory::getInstance()->register(new VanillaSponge(), true);
        (new NameChange())->init();
    }

}