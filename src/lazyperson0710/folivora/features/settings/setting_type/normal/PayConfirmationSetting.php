<?php

namespace lazyperson0710\folivora\features\settings\setting_type\normal;

use lazyperson0710\folivora\features\settings\setting_type\IPlayerSetting;

class PayConfirmationSetting implements IPlayerSetting {

    public const NAME = 'PayConfirmationSetting';

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