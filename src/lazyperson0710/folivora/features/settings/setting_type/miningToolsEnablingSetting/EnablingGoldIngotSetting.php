<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\settings\setting_type\miningToolsEnablingSetting;

use lazyperson0710\folivora\features\settings\setting_type\IPlayerSetting;

class EnablingGoldIngotSetting implements IPlayerSetting {

    public const NAME = 'EnablingGoldIngotSetting';

    public function getName() : string {
        return self::NAME;
    }

    public function getDefaultValue() : bool {
        return false;
    }

    public function normalValue() : array {
        return [
            true,
            false,
        ];
    }
}
