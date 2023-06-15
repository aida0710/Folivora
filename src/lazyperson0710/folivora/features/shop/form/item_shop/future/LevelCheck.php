<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\shop\form\item_shop\future;

use bbo51dog\bboform\form\FormBase;
use Deceitya\MiningLevel\MiningLevelAPI;
use lazyperson0710\folivora\features\shop\form\item_shop\ShopSelectForm;
use lazyperson0710\folivora\util\packet\SendForm;
use lazyperson0710\folivora\util\packet\SoundPacket;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class LevelCheck {

    public static function check(Player $player, int $restrictionLevel) : bool {
        if (MiningLevelAPI::getInstance()->getLevel($player) >= $restrictionLevel) {
            return true;
        } else {
            $error = PHP_EOL . TextFormat::RED . '要求されたレベルに達していない為処理が中断されました' . PHP_EOL . '要求レベル -> lv.' . $restrictionLevel;
            SendForm::Send($player, (new ShopSelectForm($player, $error)));
            SoundPacket::Send($player, 'dig.chain');
            return false;
        }
    }

    public static function sendForm(Player $player, FormBase $formBase, int $restrictionLevel) : void {
        if (MiningLevelAPI::getInstance()->getLevel($player) >= $restrictionLevel) {
            SendForm::Send($player, $formBase);
        } else {
            $error = PHP_EOL . TextFormat::RED . '要求されたレベルに達していない為処理が中断されました' . PHP_EOL . '要求レベル -> lv.' . $restrictionLevel;
            SendForm::Send($player, (new ShopSelectForm($player, $error)));
            SoundPacket::Send($player, 'dig.chain');
        }
    }

}
