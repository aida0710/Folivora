<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\util\message\send_message;

use pocketmine\Server;
use pocketmine\utils\TextFormat;

class SendBroadcastTip {

    public static function Send(string $message, string $prefix) : void {
        Server::getInstance()->broadcastTip(TextFormat::AQUA . $prefix . TextFormat::GRAY . ' >> ' . TextFormat::YELLOW . $message);
    }
}
