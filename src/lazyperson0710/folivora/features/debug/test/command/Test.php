<?php

namespace lazyperson0710\folivora\features\debug\test\command;

use lazyperson0710\folivora\util\message\send_message\SendMessage;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class Test extends Command {

    public function __construct() {
        parent::__construct('test', 'testコマンド');
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) : void {
        if (!($sender instanceof Player)) {
            $sender->sendMessage('サーバー内で実行してください');
            return;
        }
        SendMessage::Send($sender, 'test', 'test', true);
    }

}