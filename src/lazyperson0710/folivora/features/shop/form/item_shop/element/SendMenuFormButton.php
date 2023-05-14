<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\form\item_shop\element;

use bbo51dog\bboform\element\Button;
use bbo51dog\bboform\element\ButtonImage;
use bbo51dog\bboform\form\FormBase;
use lazyperson0710\folivora\features\shop\form\item_shop\future\LevelCheck;
use pocketmine\player\Player;

class SendMenuFormButton extends Button {

    private FormBase $form;
    private int $restrictionLevel;

    public function __construct(string $text, FormBase $form, int $restrictionLevel, ?ButtonImage $image = null) {
        parent::__construct($text, $image);
        $this->form = $form;
        $this->restrictionLevel = $restrictionLevel;
    }

    public function handleSubmit(Player $player) : void {
        LevelCheck::getInstance()->check($player, $this->form, $this->restrictionLevel);
    }
}
