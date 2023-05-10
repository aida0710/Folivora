<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\other\overwrite\block;

use lazyperson0710\folivora\util\message\send_message\SendTip;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockLegacyIds;
use pocketmine\block\BlockToolType;
use pocketmine\block\Sponge;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\BlockTransaction;

class VanillaSponge extends Sponge {

    public function __construct() {
        parent::__construct(new BlockIdentifier(BlockLegacyIds::SPONGE, 0), 'Sponge', new BlockBreakInfo(0.6, BlockToolType::HOE));
    }

    public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, Player $player = null) : bool {
        if (!$this->isWet()) {
            if (!in_array($player->getWorld()->getFolderName(), WorldCategory::NatureAll, true)) {
                SendTip::Send($player, 'このワールドではスポンジは機能しません。資源系ワールドでの使用可能です。', 'Sponge', false);
                return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
            }
            $this->absorb();
        }
        return parent::place($tx, $item, $blockReplace, $blockClicked, $face, $clickVector, $player);
    }

    private function absorb() : void {
        $pos = $this->getPosition();
        $startX = $pos->getFloorX() - 8;
        $startY = $pos->getFloorY() - 8;
        $startZ = $pos->getFloorZ() - 8;
        $world = $pos->getWorld();
        $absorbed = false;
        for ($x = 0; $x <= 16; $x++) {
            for ($y = 0; $y <= 16; $y++) {
                for ($z = 0; $z <= 16; $z++) {
                    $id = $world->getBlockAt($startX + $x, $startY + $y, $startZ + $z)->getId();
                    if ($id === BlockLegacyIds::WATER || $id === BlockLegacyIds::FLOWING_WATER || $id === BlockLegacyIds::LAVA || $id === BlockLegacyIds::FLOWING_LAVA) {
                        $world->setBlockAt($startX + $x, $startY + $y, $startZ + $z, VanillaBlocks::AIR(), true);
                        $absorbed = true;
                    }
                }
            }
        }
        if ($absorbed) {
            $this->setWet(true);
        }
    }
}
