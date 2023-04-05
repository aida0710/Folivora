<?php

declare(strict_types = 1);

namespace lazyperson0710\folivora;

use lazyperson0710\folivora\event\SampleEventListener;
use lazyperson0710\folivora\utils\Error\EventListenerNotFoundException;
use lazyperson0710\folivora\utils\ListenerList;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase {

	public function onEnable() : void {
		$this->registerEventListeners(
			new SampleEventListener(),
		);
	}

	private function registerEventListeners(ListenerList ...$list) : void {
		foreach ($list as $listener) {
			foreach ($listener->getListeners() as $event) {
				if (!$event instanceof Listener) throw new EventListenerNotFoundException("変数に格納されたクラスはListenerを実装していません");
				$this->getServer()->getPluginManager()->registerEvents($event, $this);
			}
		}
	}

	//note https://github.com/mmm545/PacketLogger/blob/6e289848dcd0d4ee3633908d54d3a4e19d3b53db/src/PacketLogger.php
}
