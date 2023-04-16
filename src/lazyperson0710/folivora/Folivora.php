<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora;

use lazyperson0710\folivora\util\config\ConfigDataPath;
use pocketmine\plugin\PluginBase;

class Folivora extends PluginBase {

	protected function onEnable() : void {
		ConfigDataPath::getInstance()->setPath($this->getDataFolder());
	}

	protected function onDisable() : void {
	}

}
