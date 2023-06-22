<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\database;

use pocketmine\entity\effect\Effect;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\lang\Translatable;
use pocketmine\Server;
use pocketmine\utils\SingletonTrait;

class EffectShopAPI {

    use SingletonTrait;

    protected array $buy = [];
    protected array $levelLimit = [];
    protected array $amplifiedMoney = [];
    protected array $timeRestriction = [];

    public function init(): void {
        $this->register(VanillaEffects::HASTE(), 600, 2, 800, 800);
        $this->register(VanillaEffects::SPEED(), 250, 15, 1200, 800);
        $this->register(VanillaEffects::REGENERATION(), 1200, 5, 800, 30);
        $this->register(VanillaEffects::NIGHT_VISION(), 50, 1, 0, 800);
        $this->register(VanillaEffects::JUMP_BOOST(), 800, 5, 1200, 30);
        $this->register(VanillaEffects::WATER_BREATHING(), 1500, 1, 0, 800);
    }

    public function register(Effect $effect, int $buy, int $levelLimit, int $amplifiedMoney, int $timeRestriction): void {
        $effectName = $effect->getName();
        if ($effectName instanceof Translatable) {
            $effectName = Server::getInstance()->getLanguage()->translate($effectName);
            //$player->getLanguage()->translate($effectName);
            //$effectName = $effectName->getText();
        }
        $this->buy[$effectName] = $buy;
        $this->levelLimit[$effectName] = $levelLimit;
        $this->amplifiedMoney[$effectName] = $amplifiedMoney;
        $this->timeRestriction[$effectName] = $timeRestriction;
    }

    public function getBuy(string $effectName): ?int {
        return $this->buy[$effectName];
    }

    public function getLevelLimit(string $effectName): ?int {
        return $this->levelLimit[$effectName];
    }

    public function getTimeRestriction(string $effectName): ?int {
        return $this->timeRestriction[$effectName];
    }

    public function getAmplifiedMoney(string $effectName): ?int {
        return $this->amplifiedMoney[$effectName];
    }

}
