<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\util\message\send_message;

use pocketmine\Server;
use pocketmine\utils\TextFormat;

class SendBroadcastMessage {

    public static function Send(string $message, string $prefix) : void {
        Server::getInstance()->broadcastMessage(TextFormat::AQUA . $prefix . TextFormat::GRAY . ' >> ' . TextFormat::YELLOW . $message);
    }
}
