<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\world_manager\blocks;

use pocketmine\block\Farmland;
use pocketmine\block\VanillaBlocks;

class FarmlandBlock extends Farmland {

    public function onRandomTick() : void {
        if ($this->getPosition()->getWorld()->getFolderName() === '八街市-f') {
            $this->wetness = 7;
            $this->position->getWorld()->setBlock($this->position, $this, false);
            return;
        }
        if (!$this->canHydrate()) {
            if ($this->wetness > 0) {
                $this->wetness--;
                $this->position->getWorld()->setBlock($this->position, $this, false);
            } else {
                $this->position->getWorld()->setBlock($this->position, VanillaBlocks::DIRT());
            }
        } elseif ($this->wetness < 7) {
            $this->wetness = 7;
            $this->position->getWorld()->setBlock($this->position, $this, false);
        }
    }

}
