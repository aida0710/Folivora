<?php

namespace lazyperson0710\folivora\features\settings\setting_type;

use pocketmine\player\Player;

class PayConfirmationSetting implements \lazyperson0710\folivora\features\settings\IPlayerSetting {

    public const NAME = 'PayConfirmationSetting';

    public function getName() : string {
        return self::NAME;
    }

    public function getDefaultValue() : bool {
        return true;
    }

    public function setValue(Player $player, mixed $value) : void {
        if (!$this->checkValue($value)) return;
        //todo コンフィグ書き込み
    }

    public function checkValue(mixed $value) : bool {
        if (is_bool($value)) {
            return true;
        }
        return false;
    }
}