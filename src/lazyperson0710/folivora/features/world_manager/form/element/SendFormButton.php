<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\world_manager\form\element;

use bbo51dog\bboform\element\Button;
use bbo51dog\bboform\element\ButtonImage;
use lazyperson0710\folivora\util\packet\SendForm;
use pocketmine\form\Form;
use pocketmine\player\Player;

class SendFormButton extends Button {

    private Form $form;

    public function __construct(Form $form, string $text, ?ButtonImage $image = null) {
        parent::__construct($text, $image);
        $this->form = $form;
    }

    public function handleSubmit(Player $player) : void {
        SendForm::Send($player, ($this->form));
    }
}
