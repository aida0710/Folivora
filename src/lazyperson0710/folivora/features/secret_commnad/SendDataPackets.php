<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\secret_commnad;

use lazyperson0710\folivora\util\message\send_message\SendMessage;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use pocketmine\event\server\DataPacketSendEvent;
use pocketmine\network\mcpe\protocol\AvailableCommandsPacket;

class SendDataPackets implements Listener {

    public const NO_PRIVILEGES = '送信されたコマンドを実行する権限がありません';

    /**
     * @param DataPacketSendEvent $event
     * @return void
     */
    public function onDataPacketSend(DataPacketSendEvent $event): void {
        foreach ($event->getPackets() as $packet) {
            if (!$packet instanceof AvailableCommandsPacket) return;
            foreach (CommandsList::SECRET as $secretCommand) {
                unset($packet->commandData[$secretCommand]);
            }
            foreach ($event->getTargets() as $networkSession) {
                if ((new SecretCommandsPlugin)->getServer()->isOp($networkSession->getPlayer()->getName())) return;
                foreach (CommandsList::OP_ONLY as $opCommand) {
                    unset($packet->commandData[$opCommand]);
                }
            }
        }
    }

    /**
     * @param PlayerCommandPreprocessEvent $event
     * @return void
     */
    public function PlayerCommandPreprocess(PlayerCommandPreprocessEvent $event): void {
        $player = $event->getPlayer();
        $message = $event->getMessage();
        if ($message === '' || $message[0] !== '/') return;
        $array = explode(' ', $message);
        $label = substr($array[0], 1);
        if (!(new SecretCommandsPlugin)->getServer()->isOp($event->getPlayer()->getName()) && in_array($label, CommandsList::OP_ONLY)) {
            SendMessage::Send($player, self::NO_PRIVILEGES, 'System', false);
            $event->cancel();
        }
    }

}