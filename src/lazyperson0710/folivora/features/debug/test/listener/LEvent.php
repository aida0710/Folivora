<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\features\debug\test\listener;

use lazyperson0710\folivora\features\settings\Setting;
use lazyperson0710\folivora\features\settings\setting_type\normal\JoinItemsSetting;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;

class LEvent implements Listener {

    /**
     *
     * @param PlayerJoinEvent $event
     * @return void
     */
    public function onJoin(PlayerJoinEvent $event) : void {
        var_dump(Setting::getInstance()->getSettingData($event->getPlayer(), new JoinItemsSetting()));
    }

    public function onBreak(BlockBreakEvent $event) : void {
        Setting::getInstance()->editSettingData($event->getPlayer(), new JoinItemsSetting(), false);
        var_dump(Setting::getInstance()->getSettingData($event->getPlayer(), new JoinItemsSetting()));
    }

}