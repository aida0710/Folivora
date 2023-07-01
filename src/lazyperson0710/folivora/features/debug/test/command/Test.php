<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\debug\test\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class Test extends Command {

    public function __construct() {
        parent::__construct('test', 'testコマンド');
    }

    /**
     * @param CommandSender $sender
     * @param string        $commandLabel
     * @param array         $args
     * @return void
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if (!($sender instanceof Player)) {
            $sender->sendMessage('サーバー内で実行してください');
            return;
        }
    }

}