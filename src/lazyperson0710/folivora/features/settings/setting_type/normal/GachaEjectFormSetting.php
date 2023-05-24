<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\settings\setting_type\normal;

use lazyperson0710\folivora\features\settings\setting_type\IPlayerSetting;

class GachaEjectFormSetting implements IPlayerSetting {

    public const NAME = 'GachaEjectFormSetting';

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
