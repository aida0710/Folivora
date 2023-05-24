<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\electronic_money\currency;

use lazyperson0710\folivora\features\electronic_money\CurrencyFoundation;
use pocketmine\player\Player;

interface ICurrency {

    public function getFunction(Player $player) : CurrencyFoundation;

}