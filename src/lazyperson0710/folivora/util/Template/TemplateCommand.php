<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\util\Template;

use lazyperson0710\folivora\util\command\CommandFoundation;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;

class TemplateCommand extends Command {

    public function __construct() {
        parent::__construct('template', 'Template');
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {
        if (!$sender instanceof Player) {
            Server::getInstance()->getLogger()->warning(CommandFoundation::NON_PLAYER);
            return false;
        }
        return true;
    }

}
