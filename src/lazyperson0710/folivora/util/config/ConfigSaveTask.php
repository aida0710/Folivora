<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora\util\config;

use lazyperson0710\folivora\util\config\features\AchievementData;
use lazyperson0710\folivora\util\config\features\PlayerData;
use lazyperson0710\folivora\util\config\features\SettingData;
use pocketmine\scheduler\Task;

class ConfigSaveTask extends Task {

    public function onRun() : void {
        (new PlayerData())->dataSave();
        (new AchievementData())->save();
        (new SettingData())->save();
    }
}
