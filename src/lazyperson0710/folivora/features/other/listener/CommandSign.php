<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\other\listener;

use lazyperson0710\folivora\util\message\send_message\SendActionBarMessage;
use lazyperson0710\folivora\util\message\send_soundless_message\SendSoundlessTip;
use lazyperson0710\folivora\util\task\IntervalTask;
use pocketmine\block\BaseSign;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\Server;

class CommandSign implements Listener {

    /**
     * @priority LOWEST
     */
    public function onTap(PlayerInteractEvent $event): void {
        $block = $event->getBlock();
        if ($block instanceof BaseSign) {
            if ($block->getText()->getLine(0) == '##cmd') {
                if (!$event->getPlayer()->isSneaking()) {
                    if (IntervalTask::check($event->getPlayer(), 'CmdSigns')) {
                        SendSoundlessTip::Send($event->getPlayer(), 'コマンド看板は1秒以内に再度使用することは出来ません', 'CmdSigns', true);
                        return;
                    } else {
                        IntervalTask::onRun($event->getPlayer(), 'CmdSigns', 20);
                    }
                    $player = $event->getPlayer();
                    $world = $player->getWorld()->getFolderName();
                    $floor_x = floor($player->getPosition()->getX());
                    $floor_y = floor($player->getPosition()->getY());
                    $floor_z = floor($player->getPosition()->getZ());
                    $table = [
                        '{name}' => $player->getName(),
                        '{x}' => $floor_x,
                        '{y}' => $floor_y,
                        '{z}' => $floor_z,
                        '{world}' => $world,
                    ];
                    $search = array_keys($table);
                    $replace = array_values($table);
                    $cmd = $block->getText()->getLine(2);
                    Server::getInstance()->dispatchCommand($event->getPlayer(), str_replace($search, $replace, $cmd));
                } else {
                    SendActionBarMessage::Send($event->getPlayer(), 'スニーク中はコマンド看板は実行されず破壊が可能です', 'CmdSigns', true);
                }
            }
        }
    }
}
