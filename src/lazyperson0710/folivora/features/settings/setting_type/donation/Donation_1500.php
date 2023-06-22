<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\settings\setting_type\donation;

use lazyperson0710\folivora\features\settings\setting_type\IPlayerSetting;

class Donation_1500 implements IPlayerSetting {

    public const NAME = 'Donation_1500';

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
