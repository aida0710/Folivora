<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\other\listener;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJumpEvent;
use pocketmine\event\player\PlayerToggleSneakEvent;
use pocketmine\math\Vector3;

class Elevator implements Listener {

    public const block = 133;
    public const elevator = 0;
    private array $sneak;

    public function onJump(PlayerJumpEvent $ev) : void {
        $p = $ev->getPlayer();
        $level = $p->getPosition()->getWorld();
        $x = $p->getPosition()->getX();
        $y = $p->getPosition()->getY();
        $z = $p->getPosition()->getZ();
        if ($this->elevator($level, $x, $y, $z)) {
            for ($i = 2; $i <= 350; $i++) {
                if (self::elevator == $level->getBlock(new Vector3($x, $y + $i, $z))->getId()) {
                    if (self::block == $level->getBlock(new Vector3($x, $y + $i - 1, $z))->getId()) {
                        $p->teleport(new Vector3($x, $y + $i, $z));
                        break;
                    }
                }
            }
        }
    }

    public function onSneak(PlayerToggleSneakEvent $ev) : void {
        $p = $ev->getPlayer();
        $n = $p->getName();
        $level = $p->getPosition()->getWorld();
        $x = $p->getPosition()->getX();
        $y = $p->getPosition()->getY();
        $z = $p->getPosition()->getZ();
        if (empty($this->sneak[$n])) {
            $this->sneak[$n] = true;
        }
        if ($ev->isSneaking()) {
            if ($this->sneak[$n]) {
                if ($this->elevator($level, $x, $y, $z)) {
                    for ($i = 2; $i <= 350; $i++) {
                        if (self::elevator == $level->getBlock(new Vector3($x, $y - $i, $z))->getId()) {
                            if (self::block == $level->getBlock(new Vector3($x, $y - $i - 1, $z))->getId()) {
                                $p->teleport(new Vector3($x, $y - $i, $z));
                                $this->sneak[$n] = false;
                                break;
                            }
                        }
                    }
                }
            }
        } else {
            $this->sneak[$n] = true;
        }
    }

    private function elevator($level, $x, $y, $z) : bool {
        $vector3 = new Vector3($x, $y, $z);
        if (self::elevator == $level->getBlock(new Vector3($x, $y, $z))->getId()) {
            if (self::block == $level->getBlock(new Vector3($x, $y - 1, $z))->getId()) {
                return true;
            }
        }
        return false;
    }

}
