<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\electronic_money\command;

use lazyperson0710\folivora\util\command\CommandFoundation;
use lazyperson0710\folivora\util\packet\SendForm;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;

class MoneyCommand extends Command {

    public function __construct() {
        parent::__construct('pay', 'お金を送金します。');
    }

    //todo 未実装
    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {
        if (!$sender instanceof Player) {
            Server::getInstance()->getLogger()->warning(CommandFoundation::NON_PLAYER);
            return false;
        }
        match ($args[0]) {
            'set' => $sender->sendMessage('set'),
            'get' => $sender->sendMessage('send'),
            'add' => $sender->sendMessage('add'),
            'reduce' => $sender->sendMessage('remove'),
            //note 未完成
            default => SendForm::Send($sender,),
        };
        return true;
    }

}
