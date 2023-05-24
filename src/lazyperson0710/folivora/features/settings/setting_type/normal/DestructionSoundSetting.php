<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\settings\setting_type\normal;

use lazyperson0710\folivora\features\settings\setting_type\IPlayerSetting;

class DestructionSoundSetting implements IPlayerSetting {

    public const NAME = 'DestructionSoundSetting';

    public function getName() : string {
        return self::NAME;
    }

    public function getDefaultValue() : bool {
        return true;
    }

    public function normalValue() : array {
        return [
            true,
            false,
        ];
    }
}
