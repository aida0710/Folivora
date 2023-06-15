<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\form\item_shop\element;

use bbo51dog\bboform\element\Button;
use bbo51dog\bboform\element\ButtonImage;
use lazyperson0710\folivora\features\shop\form\item_shop\CategorySelectForm;
use lazyperson0710\folivora\features\shop\form\item_shop\future\LevelCheck;
use lazyperson0710\folivora\util\packet\SoundPacket;
use pocketmine\player\Player;

class CategoryBackFormButton extends Button {

    public function __construct(
        string $text,
        private readonly int $shopNumber,
        private readonly int $restrictionLevel,
        ?ButtonImage $image = null,
    ) {
        parent::__construct($text, $image);
    }

    public function handleSubmit(Player $player) : void {
        SoundPacket::Send($player, 'mob.shulker.close');
        LevelCheck::sendForm($player, (new CategorySelectForm($this->shopNumber)), $this->restrictionLevel);
    }
}
