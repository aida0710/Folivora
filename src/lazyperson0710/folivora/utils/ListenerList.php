<?php

declare(strict_types=1);

namespace lazyperson0710\folivora\utils;

use pocketmine\event\Listener;

class ListenerList {

	/** @var Listener[] */
	private array $listeners = [];

	/** @return Listener[] */
	public function getListeners() : array {
		return $this->listeners;
	}

	public function registerListeners(Listener ...$listener) : void {
		/** @var Listener $listener */
		$this->listeners[] = $listener;
	}

}
