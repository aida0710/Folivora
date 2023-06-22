<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\command;

use lazyperson0710\folivora\features\shop\form\enchant_shop\EnchantSelectForm;
use lazyperson0710\folivora\util\packet\SendForm;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class EnchantShopCommand extends Command {

    public function __construct() {
        parent::__construct('ven', 'エンチャントショップを開くことができます');
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if (!($sender instanceof Player)) {
            $sender->sendMessage('サーバー内で実行してください');
            return;
        }
        SendForm::Send($sender, (new EnchantSelectForm()));
    }
}
