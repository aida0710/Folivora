<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora;

use lazyperson0710\folivora\module\task\ServerTask;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase {

	protected function onEnable() : void {
		ServerTask::getInstance()->init($this->getScheduler());
	}

	protected function onDisable() : void {
	}

}
