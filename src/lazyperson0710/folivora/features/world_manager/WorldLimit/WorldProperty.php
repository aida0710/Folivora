<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\world_manager\WorldLimit;

use pocketmine\world\Position;

class WorldProperty {

    private string $worldName;

    private int $maxX;
    private int $minX;
    private int $maxZ;
    private int $minZ;

    public function __construct(string $worldName, int $maxX, int $minX, int $maxZ, int $minZ) {
        $this->worldName = $worldName;
        if ($maxX >= $minX) {
            $this->maxX = $maxX;
            $this->minX = $minX;
        } else {
            $this->maxX = $minX;
            $this->minX = $maxX;
        }
        if ($maxZ >= $minZ) {
            $this->maxZ = $maxZ;
            $this->minZ = $minZ;
        } else {
            $this->maxZ = $minZ;
            $this->minZ = $maxZ;
        }
    }

    public function inSafeArea(Position $pos): bool {
        return $this->minX < $pos->x && $pos->x < $this->maxX && $this->minZ < $pos->z && $pos->z < $this->maxZ;
    }

    public function getWorldName(): string {
        return $this->worldName;
    }
}
