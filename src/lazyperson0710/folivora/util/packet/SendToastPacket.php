<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\util\packet;

use pocketmine\network\mcpe\protocol\ToastRequestPacket;
use pocketmine\player\Player;

class SendToastPacket {

    /**
     * @param Player $player
     * @param string $title
     * @param string $body
     * @return void
     */
    public static function Send(Player $player, string $title, string $body) : void {
        $player->getNetworkSession()->sendDataPacket(ToastRequestPacket::create($title, $body));
        SoundPacket::Send($player, 'random.toast');
    }
}
