<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\settings\setting_type\normal;

use lazyperson0710\folivora\features\settings\setting_type\IPlayerSetting;

class LevelUpDisplaySetting implements IPlayerSetting {

    public const NAME = 'LevelUpDisplaySetting';

    public function getDefaultValue(): string {
        return 'title';
    }

    public function getName(): string {
        return self::NAME;
    }

    public function normalValue(): array {
        return [
            'title',
            'toast',
            'none',
        ];
    }
}
