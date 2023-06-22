<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\util\message\send_soundless_message;

use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class SendSoundlessMessage {

    public static function Send(Player $player, string $message, string $prefix, bool $success): void {
        if ($success === true) {
            $type = TextFormat::GREEN;
        } else {
            $type = TextFormat::RED;
        }
        $player->sendMessage(TextFormat::AQUA . $prefix . TextFormat::GRAY . ' >> ' . $type . $message);
    }
}
