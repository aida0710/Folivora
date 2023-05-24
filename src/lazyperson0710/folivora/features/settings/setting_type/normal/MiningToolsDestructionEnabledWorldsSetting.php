<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\settings\setting_type\normal;

use lazyperson0710\folivora\features\settings\setting_type\IPlayerSetting;

class MiningToolsDestructionEnabledWorldsSetting implements IPlayerSetting {

    public const NAME = 'MiningToolsDestructionEnabledWorldsSetting';

    public function getName() : string {
        return self::NAME;
    }

    public function getDefaultValue() : string {
        return 'all';
    }

    public function normalValue() : array {
        return [
            'all',
            'life',
            'nature',
            'none',
        ];
    }
}
