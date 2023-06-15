<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\world_manager\EventListener;

use lazyperson0710\folivora\features\world_manager\database\WorldCategory;
use lazyperson0710\folivora\features\world_manager\database\WorldManagementAPI;
use lazyperson0710\folivora\util\message\send_message\SendActionBarMessage;
use lazyperson0710\folivora\util\message\send_message\SendMessage;
use pocketmine\event\entity\EntityTeleportEvent;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class PlayerTeleportEvent implements Listener {

    /**
     * @priority HIGH
     */
    public function PlayerTeleportEvent(EntityTeleportEvent $event) : void {
        $player = $event->getEntity();
        if (!$player instanceof Player) return;
        if ($event->getTo()->getWorld()->getDisplayName() === $event->getFrom()->getWorld()->getDisplayName()) {
            return;
        }
        $worldApi = WorldManagementAPI::getInstance();
        //note setting
        if (PlayerSettingPool::getInstance()->getSettingNonNull($player)->getSetting(MoveWorldMessageSetting::getName())?->getValue() === true) {
            if (in_array($event->getTo()->getWorld()->getDisplayName(), WorldCategory::Nature, true)) {
                SendMessage::Send($player, "天然資源ワールド\n§7>> §a自由に採掘が可能です\n§7>> §aたくさんの資源を集めてショップで売却してみよう！", '§bWorld', true);
                SendMessage::Send($player, "移動可能範囲は{$worldApi->getWorldLimitX_1($event->getTo()->getWorld()->getFolderName())} x {$worldApi->getWorldLimitZ_1($event->getTo()->getWorld()->getFolderName())}になります", '§bWorldBorder', true);
                return;
            }
            if (in_array($event->getTo()->getWorld()->getDisplayName(), WorldCategory::MiningWorld, true)) {
                SendMessage::Send($player, "MiningWorld\n§7>> §aこのワールドは一週間(日曜日の最初の再起動)ごとにリセットされます", '§bWorld', true);
                SendMessage::Send($player, "移動可能範囲は{$worldApi->getWorldLimitX_1($event->getTo()->getWorld()->getFolderName())} x {$worldApi->getWorldLimitZ_1($event->getTo()->getWorld()->getFolderName())}になります", '§bWorldBorder', true);
                return;
            }
            if (in_array($event->getTo()->getWorld()->getDisplayName(), WorldCategory::ResourceWorld, true)) {
                SendMessage::Send($player, "Resource\n§7>> §aこのワールドは中級者から上級者向けに作成されています\n§7>> §aその為お金を稼ぎたい方は天然資源をおすすめさせていただいております", '§bWorld', true);
                return;
            }
            if (in_array($event->getTo()->getWorld()->getDisplayName(), WorldCategory::LifeWorld, true)) {
                SendMessage::Send($player,
                    '建築ワールド' . PHP_EOL .
                    TextFormat::GRAY . '>> §aこのワールドは建築が可能なワールドになります' . PHP_EOL .
                    TextFormat::GRAY . '>> §a/landを実行して土地を購入してください' . PHP_EOL .
                    TextFormat::GRAY . '>> §aまた、道路の購入は規約違反となりますのでご注意ください', '§bWorld', true);
                if ($event->getTo()->getWorld()->getDisplayName() === '船橋市-c') {
                    SendMessage::Send($player, 'また、購入範囲が明確にわかるようにしてください', "§7>> §a船橋市は大きく景観を損なう行為を禁止させていただいております。例:露天掘りや大規模な整地など\n", true);
                }
                if ($event->getTo()->getWorld()->getDisplayName() === '横浜市-c') {
                    SendMessage::Send($player, '半分だけなどの購入のされ方をした場合、無断で土地を削除させていただきます', "§7>> §a横浜市は土地を買う際必ず一区画購入するようにしてください\n", true);
                }
                return;
            }
            if (in_array($event->getTo()->getWorld()->getDisplayName(), WorldCategory::AgricultureWorld, true)) {
                SendMessage::Send($player, "農業ワールド\n§7>> §aこのワールドは農業が可能なワールドになります\n§7>> §a/landを実行して土地を購入してください", '§bWorld', true);
                if (in_array($event->getTo()->getWorld()->getDisplayName(), WorldCategory::UniqueAgricultureWorld, true)) {
                    SendMessage::Send($player, '八街市はブロックの設置や破壊などが制限されたワールドになります', '', true);
                }
            }
        }
    }

}
