<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\settings\setting_type\normal;

use lazyperson0710\folivora\features\settings\setting_type\IPlayerSetting;
use pocketmine\network\mcpe\protocol\types\BossBarColor;

class BossBarColorSetting implements IPlayerSetting {

    public const NAME = 'BossBarColorSetting';

    public function getDefaultValue() : int {
        return BossBarColor::PINK;
    }

    public function getName() : string {
        return self::NAME;
    }

    public function normalValue() : array {
        return [
            BossBarColor::PINK,
            BossBarColor::BLUE,
            BossBarColor::RED,
            BossBarColor::GREEN,
            BossBarColor::YELLOW,
            BossBarColor::PURPLE,
            BossBarColor::WHITE,
        ];
    }
}
