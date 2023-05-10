<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\other\listener;

use pocketmine\event\Listener;
use pocketmine\event\server\NetworkInterfaceRegisterEvent;
use pocketmine\network\mcpe\raklib\RakLibInterface;

class GeneralEventListener implements Listener {

    public function NetworkInterfaceRegister(NetworkInterfaceRegisterEvent $event) : void {
        $rakNetInterface = $event->getInterface();
        if (!$rakNetInterface instanceof RakLibInterface) {
            return;
        }
        $rakNetInterface->setPacketLimit(128 * 128 * 128 * 128);
    }

}
