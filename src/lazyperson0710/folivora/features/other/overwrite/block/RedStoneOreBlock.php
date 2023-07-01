<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\other\overwrite\block;

use pocketmine\block\RedstoneOre;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class RedStoneOreBlock extends RedstoneOre {

    protected bool $lit = false;

    /**
     * @return int
     */
    public function getLightLevel(): int {
        return 0;
    }

    /**
     * @return bool
     */
    public function isLit(): bool {
        return true;
    }

    /**
     * @return $this
     */
    public function setLit(bool $lit = true): self {
        return $this;
    }

    /**
     * @param Item        $item
     * @param int         $face
     * @param Vector3     $clickVector
     * @param Player|null $player
     * @return bool
     */
    public function onInteract(Item $item, int $face, Vector3 $clickVector, ?Player $player = null): bool {
        return false;
    }

    /**
     * @return void
     */
    public function onNearbyBlockChange(): void {
    }

    /**
     * @param int $id
     * @param int $stateMeta
     * @return void
     */
    public function readStateFromData(int $id, int $stateMeta): void {
        $this->lit = $id === $this->idInfoFlattened->getSecondId();
    }

    /**
     * @return bool
     */
    public function ticksRandomly(): bool {
        return false;
    }

}
