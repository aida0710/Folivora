<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\util\packet;

use lazyperson0710\folivora\util\message\send_soundless_message\SendSoundlessTip;
use lazyperson0710\folivora\util\task\IntervalTask;
use pocketmine\form\Form;
use pocketmine\player\Player;

class SendForm {

    /**
     * 基本的にformをプレイヤーに送信するときは使ってください
     *
     * @param Player $player
     * @param Form $form
     * @return void
     */
    public static function Send(Player $player, Form $form) : void {
        if (IntervalTask::check($player, 'SendForm')) {
            SendSoundlessTip::Send($player, '0.3秒以内連続でFormを送信することは出来ません', 'SendForm', true);
            return;
        } else {
            IntervalTask::onRun($player, 'SendForm', 6);
        }
        $player->sendForm($form);
    }
}
