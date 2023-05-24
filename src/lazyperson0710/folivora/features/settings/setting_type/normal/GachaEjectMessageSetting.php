<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\settings\setting_type\normal;

use lazyperson0710\folivora\features\settings\setting_type\IPlayerSetting;

class GachaEjectMessageSetting implements IPlayerSetting {

    public const NAME = 'GachaEjectMessageSetting';

    public function getDefaultValue() : bool {
        return true;
    }

    public function getName() : string {
        return self::NAME;
    }

    public function normalValue() : array {
        return [
            true,
            false,
        ];
    }
}
