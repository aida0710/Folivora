<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\settings\setting_type\miningTools;

use lazyperson0710\folivora\features\settings\setting_type\IPlayerSetting;

class GrassToDirtSetting implements IPlayerSetting {

    public const NAME = 'GrassToDirtSetting';

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
