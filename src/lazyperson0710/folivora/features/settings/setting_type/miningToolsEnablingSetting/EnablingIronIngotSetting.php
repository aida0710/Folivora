<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\settings\setting_type\miningToolsEnablingSetting;

use lazyperson0710\folivora\features\settings\setting_type\IPlayerSetting;

class EnablingIronIngotSetting implements IPlayerSetting {

    public const NAME = 'EnablingIronIngotSetting';

    public function getDefaultValue(): bool {
        return false;
    }

    public function getName(): string {
        return self::NAME;
    }

    public function normalValue(): array {
        return [
            true,
            false,
        ];
    }
}
