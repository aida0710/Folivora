<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\world_manager\form\element;

use bbo51dog\bboform\element\Button;
use bbo51dog\bboform\element\ButtonImage;
use lazyperson0710\folivora\features\world_manager\form\WarpForm;
use lazyperson0710\folivora\util\packet\SendForm;
use lazyperson0710\folivora\util\packet\SoundPacket;
use pocketmine\player\Player;
use pocketmine\Server;

class CommandDispatchButton extends Button {

    private string $command;
    private bool $permission;

    public function __construct(string $text, string $command, bool $permission, ?ButtonImage $image = null) {
        parent::__construct($text, $image);
        $this->command = $command;
        $this->permission = $permission;
    }

    public function handleSubmit(Player $player) : void {
        if ($this->permission === true) {
            Server::getInstance()->dispatchCommand($player, $this->command);
        } else {
            $error = "\n§c選択したワールドはレベルが足りないか解放されていません";
            SoundPacket::Send($player, 'note.bass');
            SendForm::Send($player, (new WarpForm($player, $error)));
        }
    }
}
